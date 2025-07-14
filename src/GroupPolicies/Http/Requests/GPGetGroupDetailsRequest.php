<?php

namespace Bhry98\GP\Http\Requests;

use Bhry98\GP\Models\GPGroupsModel;
use Bhry98\Helpers\Extends\BaseRequest;
use Illuminate\Validation\Rule;

/**
 * Class RBACGetGroupDetailsRequest
 *
 * Handles validation for retrieving details about a specific RBAC group.
 * Authorization is based on the `Core.LocalRBAC.RetrieveGroup` permission.
 *
 * @package Bhry98\GP\Http\Requests
 */
class GPGetGroupDetailsRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool True if the user has the required permission.
     */
    public function authorize(): bool
    {
        return $this->user()->can('GP.RetrieveGroup')
            || $this->user()->can('GP.AllGroups')
            || $this->user()->isAdmin();
    }

    /**
     * Prepare the data for validation.
     *
     * Injects the `groupCode` from the route into the request data.
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
     * @return array<string, mixed> The validation rules for the request.
     */
    public function rules(): array
    {
        return [
            'groupCode' => [
                'required',
                'exists:' . (new GPGroupsModel)->getTable() . ',code',
            ],
            'with' => [
                'sometimes',
                'array',
            ],
            'with.*' => [
                'sometimes',
                'string',
                Rule::in(GPGroupsModel::RELATIONS),
            ],
        ];
    }
}
