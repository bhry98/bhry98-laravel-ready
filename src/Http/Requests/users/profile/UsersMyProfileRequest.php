<?php

namespace Bhry98\Bhry98LaravelReady\Http\Requests\users\profile;

use Bhry98\Bhry98LaravelReady\Models\users\UsersADManagerUsersModel;
use Bhry98\Bhry98LaravelReady\Models\users\UsersCoreUsersModel;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UsersMyProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function prepareForValidation()
    {
        $fixData = [];
        if ($this->with) $fixData["with"] = explode(separator: ',', string: $this->with);
        return $this->merge($fixData);
    }

    public function rules(): array
    {
        $rules = [];
        $rules['with'] = [
            "sometimes",
            "array",
        ];
        $rules['with.*'] = [
            "sometimes",
            "string",
            Rule::in(UsersCoreUsersModel::RELATIONS)
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
