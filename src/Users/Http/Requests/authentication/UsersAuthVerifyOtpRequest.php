<?php

namespace Bhry98\Users\Http\Requests\authentication;

use Bhry98\Helpers\extends\BaseRequest;
use Bhry98\Users\Models\UsersCoreModel;
use Bhry98\Users\Models\UsersVerifyCodesModel;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class UsersAuthVerifyOtpRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [];
        $userTable = (new UsersCoreModel)->getTable();

        $rules['email'] = [
            'nullable',
            'email',
            "exists:$userTable,email",
            'required_without:phone_number',
        ];
        $rules['phone_number'] = [
            'nullable',
            'string',
            "exists:$userTable,phone_number",
            'required_without:email',
        ];
        $rules['otp'] = ["required", "exists:" . (new UsersVerifyCodesModel)->getTable() . ",verify_code"];
        return $rules;
    }
}
