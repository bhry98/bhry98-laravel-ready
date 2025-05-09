<?php

namespace Bhry98\Bhry98LaravelReady\Http\Requests\rbac\local;

use Bhry98\Bhry98LaravelReady\Models\rbac\RBACGroupsModel;
use Bhry98\Bhry98LaravelReady\Models\rbac\RBACPermissionsModel;
use Bhry98\Bhry98LaravelReady\Models\users\UsersCoreUsersModel;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RBACRemoveUserFromGroupsRequest extends FormRequest
{

    public function authorize(): bool
    {
        return $this->user()->can("Core.LocalRBAC.UpdateUsersGroup");
    }

    public function prepareForValidation()
    {
        $fixData = [];
        $fixData["groupCode"] = $this->route('groupCode');
        return $this->merge($fixData);
    }

    public function rules(): array
    {
        $rules = [];
        $rules['groupCode'] = [
            "required",
            "exists:core." . RBACGroupsModel::TABLE_NAME . ",code"
        ];
        $rules['userCode'] = [
            "required",
            "exists:core." . UsersCoreUsersModel::TABLE_NAME . ",identity_code"
        ];
        return $rules;
    }


    public function attributes(): array
    {
        return [];
    }

    public function messages(): array
    {
        return [];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator): void
    {
        if ($this->expectsJson()) {
            $errors = collect((new \Illuminate\Validation\ValidationException($validator))->errors())->mapWithKeys(function ($messages, $key) {
                return [self::attributes()[$key] ?? $key => $messages];
            })->toArray();
            throw new \Illuminate\Http\Exceptions\HttpResponseException(
                bhry98_response_validation_error(
                    data: $errors,
                    message: (new \Illuminate\Validation\ValidationException($validator))->getMessage()
                )
            );
        }
        parent::failedValidation($validator);
    }
}
