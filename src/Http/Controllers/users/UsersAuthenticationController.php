<?php

namespace Bhry98\Bhry98LaravelReady\Http\Controllers\users;

use Bhry98\Bhry98LaravelReady\Http\Requests\users\authentication\UserAuthRegistrationRequest;
use Bhry98\Bhry98LaravelReady\Http\Requests\users\authentication\UsersAuthLoginRequest;
use Bhry98\Bhry98LaravelReady\Http\Resources\users\UserResource;
use Bhry98\Bhry98LaravelReady\Services\users\UsersAuthenticationService;
use Exception;
use Illuminate\Http\JsonResponse;
use \App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class UsersAuthenticationController extends Controller
{
    function login(UsersAuthLoginRequest $request, UsersAuthenticationService $authenticationService): JsonResponse
    {
        try {
            $token = match (bhry98_app_settings(key: "login_via", default: "username")) {
                "email" => $authenticationService->loginByEmail(email: $request->get(key: "email"), password: $request->get(key: "password")),
                "phone_number" => $authenticationService->loginByPhoneNumber(phoneNumber: $request->get(key: "phone_number"), password: $request->get(key: "password")),
                default => $authenticationService->loginByUsername(username: $request->get(key: "username"), password: $request->get(key: "password")),
            };
            if (!$token) return bhry98_response_validation_error(
                [
                    'username' => __(key: 'Bhry98::responses.login-failed'),
                    'password' => __(key: 'Bhry98::responses.login-failed'),
                ],
                __(key: "Bhry98::responses.login-failed"));
            return bhry98_response_success_with_data([
                'access_type' => 'Bearer',
                'access_token' => $token,
                "user" => UserResource::make($authenticationService->getAuthUser()),
            ]);
        } catch (Exception $e) {
            return bhry98_response_internal_error([
                'error' => $e->getMessage(),
                'code' => $e->getCode(),
                'line' => $e->getLine(),
            ]);
        }
    }

    function logout(UsersAuthenticationService $authenticationService): JsonResponse
    {
        try {
            if (!$authenticationService->logout()) return bhry98_response_validation_error(message: __(key: "Bhry98::responses.logout-failed"));
            return bhry98_response_success_with_data(message: __(key: "Bhry98::responses.logout-success"));
        } catch (Exception $e) {
            return bhry98_response_internal_error(data: [
                'error' => $e->getMessage(),
                'code' => $e->getCode(),
                'line' => $e->getLine(),
            ]);
        }
    }

    function registration(UserAuthRegistrationRequest $request, UsersAuthenticationService $usersCoreServices): JsonResponse
    {
//        return bhry98_response_success_with_data(data: $request->validated());
        try {
            DB::beginTransaction();
            $user = $usersCoreServices->registration($request->validated());
            if ($user) {
                $token = $usersCoreServices->loginViaUser($user);
                DB::commit();
                return bhry98_response_success_with_data([
                    'access_type' => 'Bearer',
                    'access_token' => $token,
                    "user" => UserResource::make($user),
                ]);
            } else {
                DB::rollBack();
                return bhry98_response_success_without_data();
            }
        } catch (\Exception $e) {
            return bhry98_response_internal_error([
                'error' => $e->getMessage(),
                'code' => $e->getCode(),
                'line' => $e->getLine(),
            ]);
        }
    }

}
