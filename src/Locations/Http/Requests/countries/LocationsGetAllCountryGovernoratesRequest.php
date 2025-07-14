<?php

namespace Bhry98\Locations\Http\Requests\countries;

use Bhry98\Helpers\extends\BaseRequest;
use Bhry98\Locations\Models\LocationsCountriesModel;
use Bhry98\Locations\Models\LocationsGovernoratesModel;
use Illuminate\Validation\Rule;

class LocationsGetAllCountryGovernoratesRequest extends BaseRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function prepareForValidation()
    {
        $fixData = [];
        $fixData["countryCode"] = $this->route('countryCode');
        $fixData["pageNumber"] = $this->pageNumber ?? 1;
        $fixData["perPage"] = $this->perPage ?? 10;
        $fixData["with"] = $this->with ? explode(",", $this->with) : null;
        return $this->merge($fixData);
    }

    public function rules(): array
    {
        $rules["countryCode"] = [
            "required",
            "exists:" . (new LocationsCountriesModel)->getTable() . ",code"
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
}
