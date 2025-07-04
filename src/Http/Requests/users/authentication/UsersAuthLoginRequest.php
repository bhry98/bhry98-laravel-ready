<?php

namespace Bhry98\Bhry98LaravelReady\Http\Requests\users\authentication;

use Bhry98\Bhry98LaravelReady\Models\users\UsersCoreUsersModel;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class UsersAuthLoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [];
        switch (bhry98_app_settings(key: "login_via", default: "username")) {
            case 'email':
                $rules['email'] = ["required", "email", "exists:" . UsersCoreUsersModel::TABLE_NAME . ",email"];
                break;
            case 'phone_number':
                $rules['phone_number'] = ["required", "exists:" . UsersCoreUsersModel::TABLE_NAME . ",phone_number"];
                break;
            default:
                $rules['username'] = ["required", "string", "exists:" . UsersCoreUsersModel::TABLE_NAME . ",username"];
        }
        $rules['password'] = [
            "required",
            "string"
        ];
        return $rules;
    }
    protected function failedValidation(Validator $validator): void
    {
        if ($this->expectsJson()) {
            $errors = collect((new ValidationException($validator))->errors())->mapWithKeys(function ($messages, $key) {
                return [self::attributes()[$key] ?? $key => $messages];
            })->toArray();
            throw new HttpResponseException(
                bhry98_response_validation_error(
                    data: $errors,
                    message: (new ValidationException($validator))->getMessage()
                )
            );
        }
        parent::failedValidation($validator);
    }
}
