<?php

namespace Bhry98\Bhry98LaravelReady\Http\Controllers\rbac;


use Bhry98\Bhry98LaravelReady\Http\Requests\rbac\local\RBACAddUserInGroupsRequest;
use Bhry98\Bhry98LaravelReady\Http\Requests\rbac\local\RBACGetAllGroupsRequest;
use Bhry98\Bhry98LaravelReady\Http\Requests\rbac\local\RBACGetAllPermissionsRequest;
use Bhry98\Bhry98LaravelReady\Http\Requests\rbac\local\RBACGetAllUsersInGroupsRequest;
use Bhry98\Bhry98LaravelReady\Http\Requests\rbac\local\RBACGetGroupDetailsRequest;
use Bhry98\Bhry98LaravelReady\Http\Requests\rbac\local\RBACRemoveUserFromGroupsRequest;
use Bhry98\Bhry98LaravelReady\Http\Resources\core\rbac\RBACGroupResource;
use Bhry98\Bhry98LaravelReady\Http\Resources\core\rbac\RBACPermissionResource;
use Bhry98\Bhry98LaravelReady\Http\Resources\users\UserResource;
use Bhry98\Bhry98LaravelReady\Services\system\rbac\RBACLocalManagementService;
use Exception;

class RBACLocalManagementController extends \App\Http\Controllers\Controller
{
    function allPermissions(RBACGetAllPermissionsRequest $request, RBACLocalManagementService $rbacService): \Illuminate\Http\JsonResponse
    {
        try {
            // get all permissions
            $permissions = $rbacService->allPermissions(
                pageNumber: $request->get(key: 'pageNumber'),
                perPage: $request->get(key: 'perPage'),
                filters: $request->get(key: 'filters'));
            if ($permissions->isEmpty()) {
                return bhry98_response_success_without_data(data: RBACPermissionResource::collection($permissions)->response()->getData(true));
            }
            return bhry98_response_success_with_data(data: RBACPermissionResource::collection($permissions)->response()->getData(true));
        } catch (\Exception $e) {
            return bhry98_response_internal_error([
                'error' => $e->getMessage(),
                'code' => $e->getCode(),
                'line' => $e->getLine(),
            ]);
        }
    }

    function allGroups(RBACGetAllGroupsRequest $request, RBACLocalManagementService $rbacService): \Illuminate\Http\JsonResponse
    {
        try {
            // get all groups
            $permissions = $rbacService->allGroups(
                pageNumber: $request->get(key: 'pageNumber'),
                perPage: $request->get(key: 'perPage'),
                filters: $request->get(key: 'filters'));
            if ($permissions->isEmpty()) {
                return bhry98_response_success_without_data(data: RBACGroupResource::collection($permissions)->response()->getData(true));
            }
            return bhry98_response_success_with_data(data: RBACGroupResource::collection($permissions)->response()->getData(true));
        } catch (\Exception $e) {
            return bhry98_response_internal_error([
                'error' => $e->getMessage(),
                'code' => $e->getCode(),
                'line' => $e->getLine(),
            ]);
        }
    }

    function groupDetails(RBACGetGroupDetailsRequest $request, RBACLocalManagementService $rbacService): \Illuminate\Http\JsonResponse
    {
        try {
            // get groups by code
            $groups = $rbacService->groupDetails(
                groupCode: $request->get(key: 'groupCode'),
                relations: $request->get(key: 'with')
            );
            if (!$groups) {
                return bhry98_response_success_without_data();
            }
            return bhry98_response_success_with_data(data: RBACGroupResource::make($groups));
        } catch (\Exception $e) {
            return bhry98_response_internal_error([
                'error' => $e->getMessage(),
                'code' => $e->getCode(),
                'line' => $e->getLine(),
            ]);
        }
    }

    function allUsersInGroups(RBACGetAllUsersInGroupsRequest $request, RBACLocalManagementService $rbacService): \Illuminate\Http\JsonResponse
    {
        try {
            // get all users from group
            $permissions = $rbacService->allUsersFromGroup(
                groupCode: $request->get(key: 'groupCode'),
                pageNumber: $request->get(key: 'pageNumber'),
                perPage: $request->get(key: 'perPage'),
                filters: $request->get(key: 'filters')
            );
            if ($permissions->isEmpty()) {
                return bhry98_response_success_without_data(data: UserResource::collection($permissions)->response()->getData(true));
            }
            return bhry98_response_success_with_data(data: UserResource::collection($permissions)->response()->getData(true));
        } catch (\Exception $e) {
            return bhry98_response_internal_error([
                'error' => $e->getMessage(),
                'code' => $e->getCode(),
                'line' => $e->getLine(),
            ]);
        }
    }

    function addUserToGroup(RBACAddUserInGroupsRequest $request, RBACLocalManagementService $rbacService): \Illuminate\Http\JsonResponse
    {
        try {
            // add user in group groups
            $groups = $rbacService->manageUserInGroup(
                groupCode: $request->get(key: "groupCode"),
                userIdentityCode: $request->get(key: "userCode")
            );
            if (!$groups) {
                return bhry98_response_success_without_data(message: __(key: 'Bhry98::responses.user-added-to-group-failed'));
            }
            return bhry98_response_success_with_data(message: __(key: 'Bhry98::responses.user-added-to-group-successfully'));
        } catch (Exception $e) {
            return bhry98_response_internal_error([
                'error' => $e->getMessage(),
                'code' => $e->getCode(),
                'line' => $e->getLine(),
            ]);
        }
    }

    function deleteUserFromGroup(RBACRemoveUserFromGroupsRequest $request, RBACLocalManagementService $rbacService): \Illuminate\Http\JsonResponse
    {
        try {
            // add user in group groups
            $groups = $rbacService->manageUserInGroup(
                groupCode: $request->get(key: "groupCode"),
                userIdentityCode: $request->get(key: "userCode"),
                add: false,
            );
            if (!$groups) {
                return bhry98_response_success_without_data(message: __(key: 'Bhry98::responses.user-deleted-from-group-failed'));
            }
            return bhry98_response_success_with_data(message: __(key: 'Bhry98::responses.user-deleted-from-group-successfully'));
        } catch (Exception $e) {
            return bhry98_response_internal_error([
                'error' => $e->getMessage(),
                'code' => $e->getCode(),
                'line' => $e->getLine(),
            ]);
        }
    }

}
