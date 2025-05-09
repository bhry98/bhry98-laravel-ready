<?php

namespace Bhry98\Bhry98LaravelReady\Http\Requests\rbac\local;

use Bhry98\Bhry98LaravelReady\Models\rbac\RBACPermissionsModel;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RBACGetAllPermissionsRequest extends FormRequest
{

    public function authorize(): bool
    {
        return $this->user()->can("Core.LocalRBAC.CreateGroup") || $this->user()->can("Core.LocalRBAC.UpdateGroup");
    }


    public function prepareForValidation()
    {
        return $this->merge([
            "pageNumber" => $this->pageNumber ?? 1,
            "perPage" => $this->perPage ?? 10,
        ]);
    }

    public function rules(): array
    {
        $rules = [
            "pageNumber" => [
                "nullable",
                "numeric",
            ],
            "perPage" => [
                "nullable",
                "numeric",
                "between:5,50",
            ],
        ];
        $rules["filters"] = [
            "sometimes",
            "array",
        ];
        return $rules;
    }


    public function attributes(): array
    {
        return [];
    }

    public function messages(): array
    {
        return [];
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
