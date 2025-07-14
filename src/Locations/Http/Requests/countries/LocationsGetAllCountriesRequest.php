<?php

namespace Bhry98\Locations\Http\Requests\countries;

use Illuminate\Foundation\Http\FormRequest;

class LocationsGetAllCountriesRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
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
            "nullable",
            "array",
        ];
        return $rules;
    }
}
