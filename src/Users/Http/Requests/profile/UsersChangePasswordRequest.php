<?php

namespace Bhry98\Bhry98LaravelReady\Http\Requests\users\profile;

use Bhry98\Bhry98LaravelReady\Models\users\UsersCoreModel;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UsersChangePasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function prepareForValidation()
    {
        $fixData = [];
        return $this->merge($fixData);
    }

    public function rules(): array
    {
        $rules = [];
        $rules['password'] = [
            "required",
            "between:8,25",
            "confirmed"
        ];
        $rules['password_confirmation'] = [
            "required",
            "same:password"
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
