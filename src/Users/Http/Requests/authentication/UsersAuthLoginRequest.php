<?php

namespace Bhry98\Users\Http\Requests\authentication;


use Bhry98\Helpers\extends\BaseRequest;
use Bhry98\Users\Models\UsersCoreModel;

class UsersAuthLoginRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [];
        $userTable = (new UsersCoreModel)->getTable();

        switch (config("bhry98.login_via", "username")) {
            case 'email':
                $rules['email'] = ["required", "email", "exists:$userTable,email"];
                break;
            case 'phone_number':
                $rules['phone_number'] = ["required", "exists:$userTable,phone_number"];
                break;
            default:
                $rules['username'] = ["required", "string", "exists:$userTable,username"];
        }
        $rules['password'] = [
            "required",
            "string"
        ];
        return $rules;
    }
}
