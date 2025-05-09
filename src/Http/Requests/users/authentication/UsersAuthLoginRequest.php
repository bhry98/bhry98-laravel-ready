<?php

namespace Bhry98\Bhry98LaravelReady\Http\Requests\users\authentication;

use Bhry98\Bhry98LaravelReady\Models\users\UsersADManagerUsersModel;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UsersAuthLoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [];
        $rules['username'] = [
            "required",
            "string",
//            "exists:core." . UsersADManagerUsersModel::TABLE_NAME . ",sam_account_name",
            Rule::exists(UsersADManagerUsersModel::class, 'sam_account_name')->whereNotNull('user_id')
        ];
        $rules['password'] = [
            "required",
            "string"
        ];
        return $rules;
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator): void
    {
        if ($this->expectsJson()) {
            $errors = collect((new \Illuminate\Validation\ValidationException($validator))->errors())->mapWithKeys(function ($messages, $key) {
                return [self::attributes()[$key] ?? $key => $messages];
            })->toArray();
            throw new \Illuminate\Http\Exceptions\HttpResponseException(
                bhry98_response_validation_error(
                    data: $errors,
                    message: (new \Illuminate\Validation\ValidationException($validator))->getMessage()
                )
            );
        }
        parent::failedValidation($validator);
    }
}
