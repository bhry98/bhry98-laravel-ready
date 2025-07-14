<?php

namespace Bhry98\Locations\Http\Requests\cities;

use Bhry98\Helpers\extends\BaseRequest;
use Bhry98\Locations\Models\LocationsCitiesModel;
use Illuminate\Validation\Rule;

class LocationsGetCityDetailsRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function prepareForValidation()
    {
        $fixData = [];
        $fixData["cityCode"] = $this->route('cityCode');

        $fixData["with"] = $this->with ? explode(",", $this->with) : null;
        return $this->merge($fixData);
    }

    public function rules(): array
    {
        $rules["cityCode"] = [
            "required",
            "exists:" . (new LocationsCitiesModel)->getTable() . ",code"
        ];
        $rules["with"] = [
            "sometimes"
        ];
        $rules["with.*"] = [
            "sometimes",
            Rule::in(LocationsCitiesModel::RELATIONS),
        ];
        return $rules;
    }
}
