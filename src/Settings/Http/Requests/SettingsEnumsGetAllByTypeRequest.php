<?php

namespace Bhry98\Settings\Http\Requests;


use Bhry98\Helpers\extends\BaseRequest;
use Bhry98\Settings\Enums\EnumsTypes;
use Illuminate\Validation\Rule;

class SettingsEnumsGetAllByTypeRequest extends BaseRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation()
    {
        $fixData = [];
        $fixData["type"] = $this->route('enumType');
        $fixData["pageNumber"] = $this->pageNumber ?? 1;
        $fixData["perPage"] = $this->perPage ?? 10;
        return $this->merge($fixData);
    }

    public function rules(): array
    {
        $rules = [];
        $rules["pageNumber"] = [
            "nullable",
            "numeric",
        ];
        $rules["perPage"] = [
            "nullable",
            "numeric",
            "between:5,50",
        ];
        $rules['type'] = [
            "required",
//            Rule::enum(EnumsTypes::class),
            Rule::in(array_map(fn($case) => $case->name, EnumsTypes::cases())),
        ];
        $rules["filters"] = [
            "nullable",
            "array",
        ];
        return $rules;
    }
}
