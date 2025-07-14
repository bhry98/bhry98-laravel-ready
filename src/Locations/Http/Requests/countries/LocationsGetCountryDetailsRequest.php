<?php

namespace Bhry98\Locations\Http\Requests\countries;

use Bhry98\Helpers\extends\BaseRequest;
use Bhry98\Locations\Models\LocationsCountriesModel;
use Illuminate\Validation\Rule;

class LocationsGetCountryDetailsRequest extends BaseRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function prepareForValidation()
    {
        $fixData = [];
        $fixData["countryCode"] = $this->route('countryCode');

        $fixData["with"] = $this->with ? explode(",", $this->with) : null;
        return $this->merge($fixData);
    }

    public function rules(): array
    {
        $rules["countryCode"] = [
            "required",
            "exists:" . (new LocationsCountriesModel)->getTable() . ",code"
        ];
        $rules["with"] = [
            "sometimes"
        ];
        $rules["with.*"] = [
            "sometimes",
            Rule::in(LocationsCountriesModel::RELATIONS),
        ];
        return $rules;
    }
}
