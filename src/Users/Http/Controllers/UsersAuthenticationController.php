<?php

namespace Bhry98\Users\Http\Controllers;

use Bhry98\Helpers\extends\BaseController;
use Bhry98\Users\Enums\UsersLoginTypes;
use Bhry98\Users\Enums\UsersResetPasswordTypes;
use Bhry98\Users\Enums\UsersVerifyCodeTypes;
use Bhry98\Users\Http\Requests\authentication\UserAuthRegistrationRequest;
use Bhry98\Users\Http\Requests\authentication\UsersAuthLoginRequest;
use Bhry98\Users\Http\Requests\authentication\UsersAuthResetPasswordRequest;
use Bhry98\Users\Http\Requests\authentication\UsersAuthVerifyOtpRequest;
use Bhry98\Users\Http\Resources\UserResource;
use Bhry98\Users\Services\UsersAuthenticationService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class UsersAuthenticationController extends BaseController
{

    public function registration(UserAuthRegistrationRequest $request, UsersAuthenticationService $usersCoreServices): JsonResponse
    {
        try {
            DB::beginTransaction();
            $user = $usersCoreServices->registration($request->validated());
            if ($user) {
                DB::commit();
                if (config("bhry98.registration.auto_login_after_register")) {
                    $token = $usersCoreServices->loginViaUser($user);
                    return bhry98_response_success_with_data([
                        'access_type' => 'Bearer',
                        'access_token' => $token,
                        "user" => UserResource::make($user),
                    ]);
                }
                return bhry98_response_success_with_data(message: __("Bhry98::responses.registration-success"));
            } else {
                DB::rollBack();
                return bhry98_response_success_without_data(message: __("Bhry98::responses.registration-failed"));
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return bhry98_response_internal_error([
                'error' => $e->getMessage(),
                'code' => $e->getCode(),
                'line' => $e->getLine(),
            ], __("Bhry98::responses.registration-failed"));
        }
    }


    public function login(UsersAuthLoginRequest $request, UsersAuthenticationService $authenticationService): JsonResponse
    {
        try {
            $userIdentifier = $request->get("email")
                ?? $request->get("phone_number")
                ?? $request->get("national_id")
                ?? $request->get("username");
            $token = $authenticationService->loginByType($userIdentifier, $request->get("password"));
            if (!$token) return bhry98_response_validation_error(message: __("Bhry98::responses.login-failed"));
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


    public function verifyOtp(UsersAuthVerifyOtpRequest $request, UsersAuthenticationService $authenticationService): JsonResponse
    {
        try {
            DB::beginTransaction();
            $validCode = $authenticationService->verifyCode($request->validated("otp"), $request->validated("type"));
            if (!$validCode) {
                DB::rollBack();
                bhry98_updated_log(false, "user verify otp failed", ['user' => auth()->user(), 'request' => $request->validated()]);
                return bhry98_response_validation_error(message: __("Bhry98::responses.otp-not-valid"));
            } else {
                DB::commit();
                bhry98_updated_log(true, "user verify otp success", ['user' => auth()->user(), 'request' => $request->validated()]);
                return bhry98_response_success_without_data(message: __("Bhry98::responses.otp-verified"));
            }
        } catch (Exception $e) {
            DB::rollBack();
            return bhry98_response_internal_error([
                'error' => $e->getMessage(),
                'code' => $e->getCode(),
                'line' => $e->getLine(),
            ]);
        }

    }

    public function logout(UsersAuthenticationService $authenticationService): JsonResponse
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


    public function resetPassword(UsersAuthResetPasswordRequest $request, UsersAuthenticationService $authenticationService): JsonResponse
    {
        try {
            $token = match (config("bhry98.reset_password_via")) {
                UsersResetPasswordTypes::EmailOtp => $authenticationService->sendResetPasswordCodeViaEmail($request->get("email")),
                UsersResetPasswordTypes::PhoneOtp => $authenticationService->sendResetPasswordCodeViaSms($request->get("phone_number")),
                default => null
            };
//            $codeSend = $authenticationService->sendResetPasswordCodeViaEmail($request->get("email"));
            if (!$token) return bhry98_response_validation_error(message: __(key: "Bhry98::responses.reset-password-failed"));
            return bhry98_response_success_with_data([
                'access_type' => 'Bearer',
                'access_token' => $token,
//                "user" => UserResource::make($authenticationService->getAuthUser()),
            ], message: __(key: "Bhry98::responses.reset-password-send"));
        } catch (Exception $e) {
            return bhry98_response_internal_error([
                'error' => $e->getMessage(),
                'code' => $e->getCode(),
                'line' => $e->getLine(),
            ]);
        }

    }

}
