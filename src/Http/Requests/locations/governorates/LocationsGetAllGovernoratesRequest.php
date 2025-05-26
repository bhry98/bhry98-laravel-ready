<?php

namespace Bhry98\Bhry98LaravelReady\Http\Requests\locations\governorates;

use Bhry98\Bhry98LaravelReady\Models\locations\LocationsCountriesModel;
use Bhry98\Bhry98LaravelReady\Models\locations\LocationsGovernoratesModel;
use Bhry98\Bhry98LaravelReady\Models\rbac\RBACPermissionsModel;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LocationsGetAllGovernoratesRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function prepareForValidation()
    {
        $fixData = [];
        $fixData["country"] = $this->country;
        $fixData["pageNumber"] = $this->pageNumber ?? 1;
        $fixData["perPage"] = $this->perPage ?? 10;
        $fixData["with"] = $this->with ? explode(",", $this->with) : null;
        return $this->merge($fixData);
    }

    public function rules(): array
    {
        $rules["country"] = [
            "nullable",
            "exists:" . LocationsCountriesModel::TABLE_NAME . ",country_code"
        ];
        $rules["pageNumber"] = [
            "nullable",
            "numeric",
        ];
        $rules["perPage"] = [
            "nullable",
            "numeric",
            "between:5,50",
        ];
        $rules["filters"] = [
            "sometimes",
            "array",
        ];
        $rules["with"] = [
            "sometimes"
        ];
        $rules["with.*"] = [
            "sometimes",
            Rule::in(LocationsGovernoratesModel::RELATIONS),
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
