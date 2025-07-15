<?php

use Bhry98\Helpers\middlewares\SetLocales;
use Bhry98\Users\Http\Controllers\UsersAuthenticationController;
use Bhry98\Users\Http\Controllers\UsersNotificationsController;
use Bhry98\Users\Http\Controllers\UsersProfileController;
use Bhry98\Users\Http\Middlewares\UserAccountEnable;
use Bhry98\Users\Http\Middlewares\UserMustChangePassword;
use Bhry98\Users\Http\Middlewares\UserMustVerifyPhone;
use Illuminate\Support\Facades\Route;

Route::name("api.")
    ->prefix("api")
    ->middleware(["api", SetLocales::class, UserMustVerifyPhone::class, UserAccountEnable::class, UserMustChangePassword::class])
    ->group(function () {
        // auth routes
        Route::name("auth.")
            ->prefix("auth")
            ->group(function () {
                Route::post("/login", [UsersAuthenticationController::class, "login"])->name("login");
                Route::post("/registration", [UsersAuthenticationController::class, "registration"])->name("registration");
                Route::post("/resetPassword", [UsersAuthenticationController::class, "resetPassword"])->name("resetPassword");
                Route::post("/verifyOtp", [UsersAuthenticationController::class, "verifyOtp"])->name("verifyOtp")->withoutMiddleware([UserMustVerifyPhone::class]);
                Route::get("/logout", [UsersAuthenticationController::class, "logout"])->name("logout")->middleware("auth:sanctum");
            });
        // account routes
        Route::name("me.")
            ->middleware(["auth:sanctum",])
            ->prefix("me")
            ->group(function () {
                Route::get("/", [UsersProfileController::class, "myProfile"])->name("myProfile")->withoutMiddleware(UserMustChangePassword::class);
                Route::put("/changePassword", [UsersProfileController::class, "changePassword"])->name("changePassword")->withoutMiddleware(UserMustChangePassword::class);
                Route::put("/", [UsersProfileController::class, "updateProfile"])->name("updateProfile");
            });
        // notifications routes
        Route::name("notifications.")
            ->middleware(["auth:sanctum"])
            ->prefix("notifications")
            ->group(function () {
                Route::get("/", [UsersNotificationsController::class, "allNotifications"])->name("allNotifications");
                Route::get("/markAllAsRead", [UsersNotificationsController::class, "markAllNotificationsAsRead"])->name("markAllNotificationsAsRead");
                Route::get("/{notificationCode}", [UsersNotificationsController::class, "notificationDetails"])->name("notificationDetails");
                Route::get("/{notificationCode}/read", [UsersNotificationsController::class, "markNotificationRead"])->name("markNotificationRead");
                Route::get("/{notificationCode}/unread", [UsersNotificationsController::class, "markNotificationUnRead"])->name("markNotificationUnRead");
            });

    });