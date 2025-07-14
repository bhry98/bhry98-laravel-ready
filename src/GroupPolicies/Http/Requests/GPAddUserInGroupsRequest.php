<?php

namespace Bhry98\GP\Http\Requests;

use Bhry98\GP\Models\GPGroupsModel;
use Bhry98\Helpers\Extends\BaseRequest;
use Bhry98\Users\Models\UsersCoreModel;

/**
 * Class GPAddUserInGroupsRequest
 *
 * Validates the request to add a user to a group in the GP module.
 * Authorization requires the `GP.UpdateGroupUsers` permission or admin privileges.
 *
 * @package Bhry98\GP\Http\Requests
 */
class GPAddUserInGroupsRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool True if the user has permission or is an admin, false otherwise.
     */
    public function authorize(): bool
    {
        return $this->user()->can('GP.UpdateGroupUsers') || $this->user()->isAdmin();
    }

    /**
     * Prepare the data for validation.
     *
     * Injects the `groupCode` from the route parameters into the request data.
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
     * @return array<string, array<int, string>> Validation rules for `groupCode` and `userCode`.
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
                'exists:' . (new UsersCoreModel)->getTable() . ',code',
            ],
        ];
    }
}
