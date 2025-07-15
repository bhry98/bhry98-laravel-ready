<?php

use Bhry98\Bhry98LaravelReady\Http\Controllers\enums\SettingsEnumsController;
use Bhry98\Bhry98LaravelReady\Http\Controllers\locations\CitiesManagementController;
use Bhry98\Bhry98LaravelReady\Http\Controllers\locations\CountriesManagementController;
use Bhry98\Bhry98LaravelReady\Http\Controllers\locations\GovernorateManagementController;
use Bhry98\Bhry98LaravelReady\Http\Controllers\rbac\RBACLocalManagementController;
use Bhry98\Bhry98LaravelReady\Http\Controllers\system\SystemSettingsController;
use Bhry98\Bhry98LaravelReady\Http\Controllers\users\UsersAuthenticationController;
use Bhry98\Bhry98LaravelReady\Http\Controllers\users\UsersProfileController;
use Bhry98\Bhry98LaravelReady\Http\Middleware\SetLocales;
use Bhry98\Bhry98LaravelReady\Http\Middleware\users\UserAccountEnable;
use Bhry98\Bhry98LaravelReady\Http\Middleware\users\UserMustChangePassword;
use Illuminate\Support\Facades\Route;


Route::name("api.")
    ->prefix("api")
    ->middleware(["api", SetLocales::class])
    ->group(function () {
         // rbac routes
        Route::name("rbac.")
            ->middleware(["auth:sanctum", UserAccountEnable::class])
            ->prefix("rbac")
            ->group(function () {
                Route::get("/permissions", [RBACLocalManagementController::class, "allPermissions"])->name("allPermissions");
                Route::get("/groups", [RBACLocalManagementController::class, "allGroups"])->name("allGroups");
                Route::get("/groups/{groupCode}", [RBACLocalManagementController::class, "groupDetails"])->name("groupDetails");
                Route::get("/groups/{groupCode}/users", [RBACLocalManagementController::class, "allUsersInGroups"])->name("allUsersInGroups");
                Route::post("/groups/{groupCode}/users", [RBACLocalManagementController::class, "addUserToGroup"])->name("addUserToGroup");
                Route::delete("/groups/{groupCode}/users", [RBACLocalManagementController::class, "deleteUserFromGroup"])->name("deleteUserFromGroup");
            });

    });