<?php

namespace Bhry98\Users\Http\Controllers;

use Bhry98\Helpers\extends\BaseController;
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
            DB::rollBack();
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
            $validCode = $authenticationService->verifyCode($request->get("otp"), $request->get("email") ?? $request->get("phone_number"));
            if (!$validCode) return bhry98_response_validation_error(message: __("Bhry98::responses.otp-not-valid"));
            $token = false;
            if ($validCode->type == UsersVerifyCodeTypes::VerifyPhone) $token = $authenticationService->verifyPhoneNumber($request->get("phone_number"));
            if ($validCode->type == UsersVerifyCodeTypes::VerifyEmail) $token = $authenticationService->verifyEmail($request->get("email"));
            return $token ? bhry98_response_success_with_data(message: __("Bhry98::responses.otp-verified")) : bhry98_response_success_with_data(message: __("Bhry98::responses.otp-verified-field"));
        } catch (Exception $e) {
            return bhry98_response_internal_error([
                'error' => $e->getMessage(),
                'code' => $e->getCode(),
                'line' => $e->getLine(),
            ]);
        }

    }

    public function login(UsersAuthLoginRequest $request, UsersAuthenticationService $authenticationService): JsonResponse
    {
        try {
            $token = match (config("bhry98.login_via", default: "username")) {
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
            $codeSend = $authenticationService->sendResetPasswordCodeViaEmail($request->get("email"));
            if (!$codeSend) return bhry98_response_validation_error(message: __(key: "Bhry98::responses.reset-password-failed"));
            return bhry98_response_success_with_data(message: __(key: "Bhry98::responses.reset-password-send"));
        } catch (Exception $e) {
            return bhry98_response_internal_error([
                'error' => $e->getMessage(),
                'code' => $e->getCode(),
                'line' => $e->getLine(),
            ]);
        }

    }

}
