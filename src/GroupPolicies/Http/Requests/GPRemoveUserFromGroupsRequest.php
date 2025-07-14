<?php

namespace Bhry98\GP\Http\Requests;

use Bhry98\GP\Models\GPGroupsModel;
use Bhry98\Helpers\Extends\BaseRequest;
use Bhry98\Users\Models\UsersCoreModel;

/**
 * Class RBACRemoveUserFromGroupsRequest
 *
 * Validates a request to remove a user from a specific RBAC group.
 * Authorization requires the `Core.LocalRBAC.UpdateUsersGroup` permission.
 *
 * @package Bhry98\GP\Http\Requests
 */
class GPRemoveUserFromGroupsRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return $this->user()->can('Core.LocalRBAC.UpdateUsersGroup');
    }

    /**
     * Prepare the data for validation.
     *
     * Injects the groupCode from the route into the request input.
     *
     * @return void
     */
    public function prepareForValidation(): void
    {
        $this->merge([
            'groupCode' => $this->route('groupCode'),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, array<int, string>>
     */
    public function rules(): array
    {
        return [
            'groupCode' => [
                'required',
                'exists:' . (new GPGroupsModel)->getTable() . ',code',
            ],
            'userCode' => [
                'required',
                'exists:' . UsersCoreModel::TABLE_NAME . ',code',
            ],
        ];
    }

    /**
     * Custom attribute names for validation errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [];
    }

    /**
     * Custom error messages for validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [];
    }
}
