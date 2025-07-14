<?php

use Bhry98\Users\Http\Controllers\UsersAuthenticationController;
use Bhry98\Users\Http\Middlewares\UserMustVerifyPhone;
use Illuminate\Support\Facades\Route;

Route::name("api.")
    ->prefix("api")
    ->middleware(["api", \Bhry98\Helpers\middlewares\SetLocales::class, UserMustVerifyPhone::class])
    ->group(function () {
        // auth routes
        Route::name("auth.")
            ->prefix("auth")
            ->group(function () {
                Route::post("/login", [UsersAuthenticationController::class, "login"])->name("login");
                Route::post("/registration", [UsersAuthenticationController::class, "registration"])->name("registration");
                Route::post("/resetPassword", [UsersAuthenticationController::class, "resetPassword"])->name("resetPassword");
                Route::post("/verifyOtp", [UsersAuthenticationController::class, "verifyOtp"])->name("verifyOtp")
                    ->withoutMiddleware([UserMustVerifyPhone::class]);
                Route::get("/logout", [UsersAuthenticationController::class, "logout"])->name("logout")->middleware("auth:sanctum");
            });
//        // account routes
//        Route::name("me.")
//            ->middleware(["auth:sanctum", UserAccountEnable::class,UserMustChangePassword::class])
//            ->prefix("me")
//            ->group(function () {
//                Route::get("/", [UsersProfileController::class, "myProfile"])->name("myProfile")->withoutMiddleware(UserMustChangePassword::class);
//                Route::put("/changePassword", [UsersProfileController::class, "changePassword"])->name("changePassword")->withoutMiddleware(UserMustChangePassword::class);
//                Route::put("/", [UsersProfileController::class, "updateProfile"])->name("updateProfile");
//            });

    });