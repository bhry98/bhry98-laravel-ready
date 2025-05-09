<?php

namespace Bhry98\Bhry98LaravelReady\Http\Controllers\users;

use Bhry98\Bhry98LaravelReady\Http\Requests\users\profile\UsersMyProfileRequest;
use Bhry98\Bhry98LaravelReady\Http\Resources\users\UserResource;
use Bhry98\Bhry98LaravelReady\Services\users\UsersAuthenticationService;
use Exception;
use Illuminate\Http\JsonResponse;

class UsersProfileController extends \App\Http\Controllers\Controller
{
    function myProfile(UsersMyProfileRequest $request, UsersAuthenticationService $authenticationService): JsonResponse
    {
        try {
            if (!$user = $authenticationService->getAuthUser(relations: $request->get(key: "with"))) return bhry98_response_not_found();
            return bhry98_response_success_with_data(UserResource::make($user));
        } catch (Exception $e) {
            return bhry98_response_internal_error([
                'error' => $e->getMessage(),
                'code' => $e->getCode(),
                'line' => $e->getLine(),
            ]);
        }
    }

}
