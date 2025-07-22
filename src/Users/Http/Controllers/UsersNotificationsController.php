<?php

namespace Bhry98\Users\Http\Controllers;

use Bhry98\Helpers\extends\BaseController;
use Bhry98\Users\Http\Requests\notifications\UsersGetNotificationsByCodeRequest;
use Bhry98\Users\Http\Requests\notifications\UsersGetNotificationsRequest;
use Bhry98\Users\Http\Resources\MessageResource;
use Bhry98\Users\Services\UsersNotificationsService;
use Exception;
use Illuminate\Http\JsonResponse;

class UsersNotificationsController extends BaseController
{
    public function allNotifications(UsersGetNotificationsRequest $request, UsersNotificationsService $notificationsService): JsonResponse
    {
        try {
            if (!$notifications = $notificationsService->getAllNotifications(withChannel: true)) return bhry98_response_not_found();
            return bhry98_response_success_with_data(MessageResource::collection($notifications)->additional([
                'meta' => $notificationsService->getNotificationsStatistics(),
            ])->response()->getData(true));
        } catch (Exception $e) {
            return bhry98_response_internal_error([
                'error' => $e->getMessage(),
                'code' => $e->getCode(),
                'line' => $e->getLine(),
            ]);
        }
    }

    public function notificationDetails(UsersGetNotificationsByCodeRequest $request, UsersNotificationsService $notificationsService): JsonResponse
    {
        try {
            if (!$notifications = $notificationsService->getNotificationByCode($request->validated('code'))) return bhry98_response_not_found();
            return bhry98_response_success_with_data(MessageResource::make($notifications));
        } catch (Exception $e) {
            return bhry98_response_internal_error([
                'error' => $e->getMessage(),
                'code' => $e->getCode(),
                'line' => $e->getLine(),
            ]);
        }
    }

    public function markNotificationRead(UsersGetNotificationsByCodeRequest $request, UsersNotificationsService $notificationsService): JsonResponse
    {
        try {
            if (!$notificationsService->markNotificationAsReadOrUnread(auth()->user(), $request->validated('code'))) return bhry98_response_not_found();
            return bhry98_response_success_with_data();
        } catch (Exception $e) {
            return bhry98_response_internal_error([
                'error' => $e->getMessage(),
                'code' => $e->getCode(),
                'line' => $e->getLine(),
            ]);
        }
    }

    public function markNotificationUnRead(UsersGetNotificationsByCodeRequest $request, UsersNotificationsService $notificationsService): JsonResponse
    {
        try {
            if (!$notificationsService->markNotificationAsReadOrUnread(auth()->user(), $request->validated('code'), false)) return bhry98_response_not_found();
            return bhry98_response_success_with_data();
        } catch (Exception $e) {
            return bhry98_response_internal_error([
                'error' => $e->getMessage(),
                'code' => $e->getCode(),
                'line' => $e->getLine(),
            ]);
        }
    }

    public function markAllNotificationsAsRead(UsersNotificationsService $notificationsService): JsonResponse
    {
        try {
            if (!$notificationsService->markAllNotificationAsRead(auth()->user())) return bhry98_response_not_found();
            return bhry98_response_success_with_data();
        } catch (Exception $e) {
            return bhry98_response_internal_error([
                'error' => $e->getMessage(),
                'code' => $e->getCode(),
                'line' => $e->getLine(),
            ]);
        }
    }
}
