<?php

use Illuminate\Http\Resources\Json\JsonResource;

if (!function_exists(function: 'bhry98_response_success_with_data')) {
    function bhry98_response_success_with_data(array|JsonResource $data = [], string $message = ''): \Illuminate\Http\JsonResponse
    {
        return response()->json(
            data: [
                'success' => true,
                'code' => 200,
                'data' => $data,
                'message' => $message,
                'note' => __(key: "Bhry98::responses.success-with-data"),
            ]
        );
    }
}
if (!function_exists(function: 'bhry98_response_success_without_data')) {
    function bhry98_response_success_without_data(array $data = [], string $message = ''): \Illuminate\Http\JsonResponse
    {
        return response()->json(
            data: [
                'success' => true,
                'code' => 200,
                'data' => $data,
                'message' => $message,
                'note' => __(key: "Bhry98::responses.success-without-data"),
            ],
        );
    }
}
if (!function_exists(function: 'bhry98_response_not_found')) {
    function bhry98_response_not_found(array $data = [], string $message = ''): \Illuminate\Http\JsonResponse
    {
        return response()->json(
            data: [
                'success' => false,
                'code' => 404,
                'data' => $data,
                'message' => $message,
                'note' => __(key: "Bhry98::responses.not-found"),
            ],
            status: 404
        );
    }
}
if (!function_exists(function: 'bhry98_response_validation_error')) {
    function bhry98_response_validation_error(array $data = [], string $message = ''): \Illuminate\Http\JsonResponse
    {
        return response()->json(
            data: [
                'success' => false,
                'code' => 400,
                'data' => $data,
                'message' => $message,
                'note' => __(key: "Bhry98::responses.validation-error"),
            ],
            status: 400
        );
    }
}
if (!function_exists(function: 'bhry98_response_internal_error')) {
    function bhry98_response_internal_error(array $data = [], string $message = ''): \Illuminate\Http\JsonResponse
    {
        \Illuminate\Support\Facades\Log::error(">>> " . $message . " <<<", $data);
        return response()->json(
            data: [
                'success' => false,
                'code' => 500,
                'data' => $data,
                'message' => $message,
                'note' => __(key: "Bhry98::responses.internal-error"),
            ],
            status: 500
        );
    }
}
if (!function_exists(function: 'bhry98_response_unauthenticated')) {
    function bhry98_response_unauthenticated(string $message = ''): \Illuminate\Http\JsonResponse
    {

        return response()->json(
            data: [
                'success' => false,
                'code' => 401,
                'message' => app()->getLocale(), //$message,
                'note' => __(key: "Bhry98::responses.unauthenticated"),
            ],
            status: 401
        );
    }
}
if (!function_exists(function: 'bhry98_response_authorization_error')) {
    function bhry98_response_authorization_error(string $message = ''): \Illuminate\Http\JsonResponse
    {
        return response()->json(
            data: [
                'success' => false,
                'code' => 403,
                'message' => $message,
                'note' => __(key: "Bhry98::responses.forbidden"),
            ],
            status: 403
        );
    }
}

