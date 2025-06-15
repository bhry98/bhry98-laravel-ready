<?php

namespace Bhry98\Bhry98LaravelReady\Http\Requests\users\authentication;

use Bhry98\Bhry98LaravelReady\Models\users\UsersCoreUsersModel;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class UsersAuthResetPasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [];
        $rules['email'] = ["required", "email", "exists:" . UsersCoreUsersModel::TABLE_NAME . ",email"];
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
