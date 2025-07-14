<?php

namespace Bhry98\Helpers\extends;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BaseRequest extends FormRequest
{

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator): void
    {
        if ($this->expectsJson()) {
            $errors = collect((new \Illuminate\Validation\ValidationException($validator))->errors())->mapWithKeys(function ($messages, $key) {
                return [self::attributes()[$key] ?? $key => $messages];
            })->toArray();
            throw new \Illuminate\Http\Exceptions\HttpResponseException(bhry98_response_validation_error($errors, (new \Illuminate\Validation\ValidationException($validator))->getMessage()));
        }
        parent::failedValidation($validator);
    }
}
