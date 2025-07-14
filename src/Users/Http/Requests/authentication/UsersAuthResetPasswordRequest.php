<?php

namespace Bhry98\Users\Http\Requests\authentication;

use Bhry98\Helpers\extends\BaseRequest;
use Bhry98\Users\Models\UsersCoreModel;

class UsersAuthResetPasswordRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $userTable = (new UsersCoreModel)->getTable();

        $rules = [];
        $rules['email'] = ["required", "email", "exists:$userTable,email"];
        return $rules;
    }
}
