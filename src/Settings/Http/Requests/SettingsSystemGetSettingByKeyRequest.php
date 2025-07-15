<?php

namespace Bhry98\Settings\Http\Requests;

use Bhry98\Helpers\extends\BaseRequest;

class SettingsSystemGetSettingByKeyRequest extends BaseRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation()
    {
        $fixData = [];
        $fixData["key"] = $this->route('settingKey');
        return $this->merge($fixData);
    }

    public function rules(): array
    {
        $rules = [];
        $rules['key'] = ["required"];
        return $rules;
    }
}
