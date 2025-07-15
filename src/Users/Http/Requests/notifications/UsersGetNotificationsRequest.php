<?php

namespace Bhry98\Users\Http\Requests\notifications;


use Bhry98\Helpers\extends\BaseRequest;

class UsersGetNotificationsRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function prepareForValidation()
    {
        $fixData['ordering'] = 'desc';
        return $this->merge($fixData);
    }

    public function rules(): array
    {
        $rules = [];
        $rules['ordering'] = [
            "required",
            "in:desc,asc"
        ];
        return $rules;
    }
}
