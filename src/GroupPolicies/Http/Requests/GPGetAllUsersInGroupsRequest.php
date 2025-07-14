<?php

namespace Bhry98\GP\Http\Requests;

use Bhry98\Helpers\Extends\BaseRequest;
use Bhry98\GP\Models\GPGroupsModel;

/**
 * Class RBACGetAllUsersInGroupsRequest
 *
 * Handles validation and authorization for fetching users assigned to a specific group.
 * Authorization is granted if the user can update or view all groups or is an admin.
 *
 * @package Bhry98\GP\Http\Requests
 */
class GPGetAllUsersInGroupsRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool True if the user has the proper permissions or is an admin.
     */
    public function authorize(): bool
    {
        return $this->user()->can('GP.UpdateGroups')
            || $this->user()->can('GP.AllGroups')
            || $this->user()->isAdmin();
    }

    /**
     * Prepare the data for validation.
     *
     * Injects default pagination parameters and group code from the route into request data.
     *
     * @return void
     */
    public function prepareForValidation(): void
    {
        $this->merge([
            'groupCode' => $this->route('groupCode'),
            'pageNumber' => $this->pageNumber ?? 1,
            'perPage' => $this->perPage ?? 10,
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, array<int, string>> Validation rules for pagination, filtering, and group code.
     */
    public function rules(): array
    {
        return [
            'pageNumber' => [
                'nullable',
                'numeric',
            ],
            'perPage' => [
                'nullable',
                'numeric',
                'between:5,50',
            ],
            'groupCode' => [
                'required',
                'exists:' . (new GPGroupsModel)->getTable() . ',code',
            ],
            'filters' => [
                'sometimes',
                'array',
            ],
        ];
    }
}
