<?php

namespace Bhry98\Bhry98LaravelReady\Http\Controllers\users;

use Bhry98\Bhry98LaravelReady\Http\Requests\users\profile\UsersChangePasswordRequest;
use Bhry98\Bhry98LaravelReady\Http\Requests\users\profile\UsersMyProfileRequest;
use Bhry98\Bhry98LaravelReady\Http\Requests\users\profile\UserUpdateProfileRequest;
use Bhry98\Bhry98LaravelReady\Http\Resources\users\UserResource;
use Bhry98\Bhry98LaravelReady\Services\users\UsersAuthenticationService;
use Bhry98\Bhry98LaravelReady\Services\users\UsersManagementService;
use Exception;
use Illuminate\Http\JsonResponse;

class UsersProfileController extends \App\Http\Controllers\Controller
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
            if (!$userService->updateProfile(identityCode: auth()->user()?->identity_code, data: $request->validated())) return bhry98_response_not_found(message: __(key: "Bhry98::responses.your-profile-updated-field"));
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
