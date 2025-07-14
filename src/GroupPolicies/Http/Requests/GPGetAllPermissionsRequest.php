<?php

namespace Bhry98\GP\Http\Requests;

use Bhry98\Helpers\Extends\BaseRequest;

/**
 * Class RBACGetAllPermissionsRequest
 *
 * Handles validation and authorization for retrieving a paginated list of available RBAC permissions.
 * Authorization is granted if the user has group management permissions or is an admin.
 *
 * @package Bhry98\GP\Http\Requests
 */
class GPGetAllPermissionsRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool True if the user has permission to manage groups or is an admin.
     */
    public function authorize(): bool
    {
        return $this->user()->can("GP.CreateGroups")
            || $this->user()->can("GP.UpdateGroups")
            || $this->user()->isAdmin();
    }

    /**
     * Prepare the data for validation.
     *
     * Sets default values for pagination parameters if they are not already provided.
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
     * @return array<string, array<int, string>> Validation rules for pagination and filtering.
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
