<?php

namespace Bhry98\GP\Http\Requests;

use Bhry98\Helpers\Extends\BaseRequest;

/**
 * Class GPGetAllGroupsRequest
 *
 * Handles validation and authorization for retrieving a paginated and optionally filtered list of groups.
 * Includes default pagination values and permission-based access control.
 *
 * @package Bhry98\GP\Http\Requests
 */
class GPGetAllGroupsRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * Authorization is granted if the user has the `GP.AllGroups` permission or is an admin.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return $this->user()->can('GP.AllGroups') || $this->user()->isAdmin();
    }

    /**
     * Prepare the data for validation.
     *
     * Applies default pagination values (`pageNumber = 1`, `perPage = 10`) if not present.
     *
     * @return void
     */
    public function prepareForValidation(): void
    {
        $this->merge([
            'pageNumber' => $this->pageNumber ?? 1,
            'perPage' => $this->perPage ?? 10,
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * - `pageNumber`: Optional numeric page index.
     * - `perPage`: Optional number of results per page (between 5 and 50).
     * - `filters`: Optional array of filtering rules.
     *
     * @return array<string, array<int, string>>
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
            'filters' => [
                'sometimes',
                'array',
            ],
        ];
    }
}
