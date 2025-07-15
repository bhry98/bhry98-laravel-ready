<?php

namespace Bhry98\Users\Http\Controllers;

use Bhry98\Helpers\extends\BaseController;
use Bhry98\Users\Http\Requests\profile\UsersChangePasswordRequest;
use Bhry98\Users\Http\Requests\profile\UsersMyProfileRequest;
use Bhry98\Users\Http\Requests\profile\UserUpdateProfileRequest;
use Bhry98\Users\Http\Resources\UserResource;
use Bhry98\Users\Services\UsersManagementService;
use Exception;
use Illuminate\Http\JsonResponse;

class UsersProfileController extends BaseController
{
    function myProfile(UsersMyProfileRequest $request, UsersManagementService $userService): JsonResponse
    {
        try {
            if (!$user = $userService->getById(id: auth()->id(), relations: $request->get(key: "with"))) return bhry98_response_not_found();
            return bhry98_response_success_with_data(UserResource::make($user));
        } catch (Exception $e) {
            return bhry98_response_internal_error([
                'error' => $e->getMessage(),
                'code' => $e->getCode(),
                'line' => $e->getLine(),
            ]);
        }
    }

    function changePassword(UsersChangePasswordRequest $request, UsersManagementService $userService): JsonResponse
    {
        try {

            if (!$userService->changeMyPassword(newPassword: $request->get(key: "password"))) return bhry98_response_not_found();
            return bhry98_response_success_with_data(message: __(key: "Bhry98::responses.password-changed-successfully"));
        } catch (Exception $e) {
            return bhry98_response_internal_error([
                'error' => $e->getMessage(),
                'code' => $e->getCode(),
                'line' => $e->getLine(),
            ]);
        }
    }

    function updateProfile(UserUpdateProfileRequest $request, UsersManagementService $userService): JsonResponse
    {

//        return bhry98_response_success_with_data(data: $request->validated());
        try {
            if (!$request->validated()) return bhry98_response_validation_error(message: __(key: "Bhry98::responses.no-data-in-validation-failed"));

            if (!$userService->updateProfile(code: auth()->user()?->code, data: $request->validated())) return bhry98_response_not_found(message: __(key: "Bhry98::responses.your-profile-updated-field"));
            return bhry98_response_success_with_data(message: __(key: "Bhry98::responses.your-profile-updated-successfully"));
        } catch (Exception $e) {
            return bhry98_response_internal_error([
                'error' => $e->getMessage(),
                'code' => $e->getCode(),
                'line' => $e->getLine(),
            ]);
        }
    }

}
