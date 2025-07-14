<?php

namespace Bhry98\Locations\Http\Requests\governorates;

use Bhry98\Helpers\extends\BaseRequest;
use Bhry98\Locations\Models\LocationsCitiesModel;
use Bhry98\Locations\Models\LocationsGovernoratesModel;
use Illuminate\Validation\Rule;

class LocationsGetAllGovernorateCitiesRequest extends BaseRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function prepareForValidation()
    {
        $fixData = [];
        $fixData["governorateCode"] = $this->route('governorateCode');
        $fixData["pageNumber"] = $this->pageNumber ?? 1;
        $fixData["perPage"] = $this->perPage ?? 10;
        $fixData["with"] = $this->with ? explode(",", $this->with) : null;
        return $this->merge($fixData);
    }

    public function rules(): array
    {
        $rules["governorateCode"] = [
            "required",
            "exists:" . (new LocationsGovernoratesModel)->getTable() . ",code"
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
            Rule::in(LocationsCitiesModel::RELATIONS),
        ];
        return $rules;
    }
}
