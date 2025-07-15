<?php

namespace Bhry98\Users\Http\Requests\profile;

use Bhry98\Helpers\extends\BaseRequest;
use Bhry98\Users\Models\UsersCoreModel;
use Illuminate\Validation\Rule;

class UsersMyProfileRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function prepareForValidation()
    {
        $fixData = [];
        if ($this->with) $fixData["with"] = explode(separator: ',', string: $this->with);
        return $this->merge($fixData);
    }

    public function rules(): array
    {
        $rules = [];
        $rules['with'] = [
            "sometimes",
            "array",
        ];
        $rules['with.*'] = [
            "sometimes",
            "string",
            Rule::in(UsersCoreModel::RELATIONS)
        ];
        return $rules;
    }
}
