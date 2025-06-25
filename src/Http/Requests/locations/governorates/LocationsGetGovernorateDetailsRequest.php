<?php

namespace Bhry98\Bhry98LaravelReady\Http\Requests\locations\governorates;

use Bhry98\Bhry98LaravelReady\Models\locations\LocationsGovernoratesModel;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LocationsGetGovernorateDetailsRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function prepareForValidation()
    {
        $fixData = [];
        $fixData["governorateCode"] = $this->route('governorateCode');

        $fixData["with"] = $this->with ? explode(",", $this->with) : null;
        return $this->merge($fixData);
    }

    public function rules(): array
    {
        $rules["governorateCode"] = [
            "required",
            "exists:" . LocationsGovernoratesModel::TABLE_NAME . ",code"
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
