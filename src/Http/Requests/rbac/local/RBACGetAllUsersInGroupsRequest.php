<?php

namespace Bhry98\Bhry98LaravelReady\Http\Requests\rbac\local;

use Bhry98\Bhry98LaravelReady\Models\rbac\RBACGroupsModel;
use Bhry98\Bhry98LaravelReady\Models\rbac\RBACPermissionsModel;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RBACGetAllUsersInGroupsRequest extends FormRequest
{

    public function authorize(): bool
    {
        return $this->user()->can("Core.CoreUsers.UpdateUsersGroup") || $this->user()->can("Core.LocalRBAC.RetrieveGroup");
    }

    public function prepareForValidation()
    {
        $fixData = [];
        $fixData["groupCode"] = $this->route('groupCode');
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
        $rules['groupCode'] = [
            "required",
            "exists:" . RBACGroupsModel::TABLE_NAME . ",code"
        ];
        $rules["filters"] = [
            "sometimes",
            "array",
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
