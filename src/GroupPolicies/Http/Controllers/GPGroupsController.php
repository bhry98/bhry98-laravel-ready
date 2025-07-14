<?php

namespace Bhry98\GP\Http\Controllers;

use Bhry98\GP\Http\Requests\GPAddUserInGroupsRequest;
use Bhry98\GP\Http\Requests\GPGetAllGroupsRequest;
use Bhry98\GP\Http\Requests\GPGetAllUsersInGroupsRequest;
use Bhry98\GP\Http\Requests\GPGetGroupDetailsRequest;
use Bhry98\GP\Http\Requests\GPRemoveUserFromGroupsRequest;
use Bhry98\GP\Http\Resources\GPGroupResource;
use Bhry98\GP\Services\GPGroupsService;
use Bhry98\Users\Http\Resources\UserResource;
use Exception;
use Illuminate\Http\JsonResponse;

/**
 * Class GPGroupsController
 * Handles group-related RBAC operations.
 */
class GPGroupsController extends \App\Http\Controllers\Controller
{
    /**
     * Retrieve all groups with pagination and optional filters.
     */
    public function allGroups(GPGetAllGroupsRequest $request, GPGroupsService $groupService): JsonResponse
    {
        try {
            $groups = $groupService->allGroups(
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

    /**
     * Retrieve group details by code with optional relations.
     */
    public function groupDetails(GPGetGroupDetailsRequest $request, GPGroupsService $groupService): JsonResponse
    {
        try {
            $group = $groupService->groupDetails(
                groupCode: $request->get('groupCode'),
                relations: $request->get('with')
            );

            if (!$group) {
                return bhry98_response_success_without_data();
            }

            return bhry98_response_success_with_data(GPGroupResource::make($group));

        } catch (Exception $e) {
            return bhry98_response_internal_error([
                'error' => $e->getMessage(),
                'code' => $e->getCode(),
                'line' => $e->getLine(),
            ]);
        }
    }

    /**
     * Retrieve all users associated with a group.
     */
    public function allUsersInGroups(GPGetAllUsersInGroupsRequest $request, GPGroupsService $groupService): JsonResponse
    {
        try {
            $users = $groupService->allUsersFromGroup(
                groupCode: $request->get('groupCode'),
                pageNumber: $request->get('pageNumber'),
                perPage: $request->get('perPage'),
                filters: $request->get('filters')
            );

            $data = UserResource::collection($users)->response()->getData(true);

            return $users->isEmpty()
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
     * Add a user to a group.
     */
    public function addUserToGroup(GPAddUserInGroupsRequest $request, GPGroupsService $groupService): JsonResponse
    {
        try {
            $success = $groupService->manageUserInGroup(
                groupCode: $request->get('groupCode'),
                userCode: $request->get('userCode')
            );
            return $success
                ? bhry98_response_success_with_data(message: __('Bhry98::responses.user-added-to-group-successfully'))
                : bhry98_response_success_without_data(message: __('Bhry98::responses.user-added-to-group-failed'));
        } catch (Exception $e) {
            return bhry98_response_internal_error([
                'error' => $e->getMessage(),
                'code' => $e->getCode(),
                'line' => $e->getLine(),
            ]);
        }
    }

    /**
     * Remove a user from a group.
     */
    public function deleteUserFromGroup(GPRemoveUserFromGroupsRequest $request, GPGroupsService $groupService): JsonResponse
    {
        try {
            $success = $groupService->manageUserInGroup(
                groupCode: $request->get('groupCode'),
                userCode: $request->get('userCode')
            );

            return $success
                ? bhry98_response_success_with_data(message: __('Bhry98::responses.user-deleted-from-group-successfully'))
                : bhry98_response_success_without_data(message: __('Bhry98::responses.user-deleted-from-group-failed'));

        } catch (Exception $e) {
            return bhry98_response_internal_error([
                'error' => $e->getMessage(),
                'code' => $e->getCode(),
                'line' => $e->getLine(),
            ]);
        }
    }
}
