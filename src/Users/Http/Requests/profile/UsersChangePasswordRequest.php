<?php

namespace Bhry98\Users\Http\Requests\profile;


use Bhry98\Helpers\extends\BaseRequest;

class UsersChangePasswordRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function prepareForValidation()
    {
        $fixData = [];
        return $this->merge($fixData);
    }

    public function rules(): array
    {
        $rules = [];
        $rules['password'] = [
            "required",
            "between:8,25",
            "confirmed"
        ];
        $rules['password_confirmation'] = [
            "required",
            "same:password"
        ];
        return $rules;
    }
}
