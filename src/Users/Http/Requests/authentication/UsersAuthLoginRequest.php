<?php

namespace Bhry98\Users\Http\Requests\authentication;


use Bhry98\Helpers\extends\BaseRequest;
use Bhry98\Users\Enums\UsersLoginTypes;
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
        switch (config("bhry98.login_type")) {
            case UsersLoginTypes::EmailOtp:
            case UsersLoginTypes::EmailPassword:
                $rules['email'] = ["required", "email", "exists:$userTable,email"];
                break;
            case UsersLoginTypes::PhonePassword:
            case UsersLoginTypes::PhoneOtp:
                $rules['phone_number'] = ["required", "phone", "exists:$userTable,phone_number"];
                break;
            case UsersLoginTypes::NationalIdPassword:
                $rules['national_id'] = ["required", "exists:$userTable,national_id"];
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
