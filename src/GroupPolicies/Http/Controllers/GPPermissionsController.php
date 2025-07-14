<?php

namespace Bhry98\GP\Http\Controllers;

use Bhry98\GP\Http\Requests\GPGetAllPermissionsRequest;
use Bhry98\GP\Http\Requests\GPGetPermissionDetailsRequest;
use Bhry98\GP\Http\Requests\GPGetGroupsOfPermissionRequest;
use Bhry98\GP\Http\Resources\GPPermissionResource;
use Bhry98\GP\Http\Resources\GPGroupResource;
use Bhry98\GP\Services\GPPermissionsService;
use Illuminate\Http\JsonResponse;
use Exception;

/**
 * Class GPPermissionsController
 * Handles permission-related RBAC operations.
 */
class GPPermissionsController extends \App\Http\Controllers\Controller
{
    /**
     * Retrieve all permissions with pagination and optional filters.
     */
    public function allPermissions(GPGetAllPermissionsRequest $request, GPPermissionsService $permissionService): JsonResponse
    {
        try {
            $permissions = $permissionService->allPermissions(
                pageNumber: $request->get('pageNumber'),
                perPage: $request->get('perPage'),
                filters: $request->get('filters')
            );

            $data = GPPermissionResource::collection($permissions)->response()->getData(true);

            return $permissions->isEmpty()
                ? bhry98_response_success_without_data($data)
                : bhry98_response_success_with_data($data);

        } catch (Exception $e) {
            return bhry98_response_internal_error([
                'error' => $e->getMessage(),
                'code' => $e->getCode(),
                'line' => $e->getLine(),
            ]);
        }
    }

    /**
     * Retrieve permission details by code with optional relations.
     */
    public function permissionDetails(GPGetPermissionDetailsRequest $request, GPPermissionsService $permissionService): JsonResponse
    {
        try {
            $permission = $permissionService->getPermissionByCode(
                code: $request->get('permissionCode'),
                relations: $request->get('with')
            );

            if (!$permission) {
                return bhry98_response_success_without_data();
            }

            return bhry98_response_success_with_data(GPPermissionResource::make($permission));

        } catch (Exception $e) {
            return bhry98_response_internal_error([
                'error' => $e->getMessage(),
                'code' => $e->getCode(),
                'line' => $e->getLine(),
            ]);
        }
    }

    /**
     * Retrieve all groups associated with a given permission.
     */
    public function allGroupsOfPermission(GPGetGroupsOfPermissionRequest $request, GPPermissionsService $permissionService): JsonResponse
    {
        try {
            $groups = $permissionService->allGroupsOfPermission(
                permissionCode: $request->get('permissionCode'),
                pageNumber: $request->get('pageNumber'),
                perPage: $request->get('perPage'),
                filters: $request->get('filters')
            );

            $data = GPGroupResource::collection($groups)->response()->getData(true);

            return $groups->isEmpty()
                ? bhry98_response_success_without_data($data)
                : bhry98_response_success_with_data($data);

        } catch (Exception $e) {
            return bhry98_response_internal_error([
                'error' => $e->getMessage(),
                'code' => $e->getCode(),
                'line' => $e->getLine(),
            ]);
        }
    }
}
