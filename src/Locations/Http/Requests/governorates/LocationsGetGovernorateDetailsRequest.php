<?php

namespace Bhry98\Locations\Http\Requests\governorates;

use Bhry98\Helpers\extends\BaseRequest;
use Bhry98\Locations\Models\LocationsGovernoratesModel;
use Illuminate\Validation\Rule;

class LocationsGetGovernorateDetailsRequest extends BaseRequest
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
            "exists:" . (new LocationsGovernoratesModel)->getTable() . ",code"
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
