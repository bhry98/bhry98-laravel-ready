<?php

use Bhry98\Bhry98LaravelReady\Http\Controllers\enums\EnumsManagementController;
use Bhry98\Bhry98LaravelReady\Http\Controllers\locations\CountriesManagementController;
use Bhry98\Bhry98LaravelReady\Http\Controllers\locations\GovernorateManagementController;
use Bhry98\Bhry98LaravelReady\Http\Controllers\rbac\RBACLocalManagementController;
use Bhry98\Bhry98LaravelReady\Http\Controllers\users\UsersAuthenticationController;
use Bhry98\Bhry98LaravelReady\Http\Controllers\users\UsersProfileController;
use Bhry98\Bhry98LaravelReady\Http\Middleware\GlobalResponseLocale;
use Bhry98\Bhry98LaravelReady\Http\Middleware\users\UserAccountEnable;
use Illuminate\Support\Facades\Route;


Route::name("api.")
    ->prefix("api")
    ->middleware(["api", GlobalResponseLocale::class])
    ->group(function () {
        // auth routes
        Route::name("auth.")
            ->prefix("auth")
            ->group(function () {
                Route::post("/login", [UsersAuthenticationController::class, "login"])->name("login");
                Route::post("/registration", [UsersAuthenticationController::class, "registration"])->name("registration");
                Route::post("/resetPassword", [UsersAuthenticationController::class, "resetPassword"])->name("resetPassword");
                Route::get("/logout", [UsersAuthenticationController::class, "logout"])->name("logout")->middleware("auth:sanctum");
            });
        // account routes
        Route::name("me.")
            ->middleware(["auth:sanctum", UserAccountEnable::class])
            ->prefix("me")
            ->group(function () {
                Route::get("/", [UsersProfileController::class, "myProfile"])->name("myProfile");
                Route::put("/changePassword", [UsersProfileController::class, "changePassword"])->name("changePassword");
                Route::put("/", [UsersProfileController::class, "updateProfile"])->name("updateProfile");
            });
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
        // enums routes
        Route::name("enums.")
//            ->middleware(["auth:sanctum", UserAccountEnable::class])
            ->prefix("enums")
            ->group(function () {
                Route::get("/{enumType}", [EnumsManagementController::class, "allByType"])->name("allByType");
            });
        // locations routes
        Route::name("locations.")
            ->prefix("locations")
            ->group(function () {
                Route::get("countries", [CountriesManagementController::class, "all"])->name("countries.all");
                Route::get("countries/{countryCode}", [CountriesManagementController::class, "details"])->name("countries.details");
                Route::get("countries/{countryCode}/governorates", [CountriesManagementController::class, "allGovernorate"])->name("countries.allGovernorate");
                Route::get("countries/{countryCode}/cities", [CountriesManagementController::class, "allCities"])->name("countries.allCities");
                Route::get("governorates", [GovernorateManagementController::class, "all"])->name("governorates.all");
            });

    });
//// core users routes
//Route::name("users")
//    ->middleware(["auth:sanctum"])
//    ->prefix("users")
//    ->group(function () {
//        Route::get("/", [UsersManagementController::class, "allUsers"])->name("allUsers");
//        Route::post("/", [UsersManagementController::class, "createUser"])->name("createUser");
//        Route::put("/{identityCode}", [UsersManagementController::class, "updateUser"])->name("updateUser");
//        Route::get("/{identityCode}", [UsersManagementController::class, "userDetails"])->name("userDetails");
//        Route::get("/{identityCode}/groups", [UsersManagementController::class, "userGroups"])->name("userGroups");
//        Route::put("/disableAccount", [UsersManagementController::class, "disableAccount"])->name("disableAccount");
//        Route::put("/enableAccount", [UsersManagementController::class, "enableAccount"])->name("enableAccount");
//    });
//
//// azure routes
//Route::name("azureUsers")
//    ->middleware(["auth:sanctum"])
//    ->prefix("azureUsers")
//    ->group(function () {
//        Route::get("/", [UsersAzureManagementController::class, "allUsers"])->name("allUsers");;
//        Route::post("/syncFromAzure", [UsersAzureManagementController::class, "syncFromAzure"])->name("syncFromAzure");
//        Route::put("/disableAccount", [UsersAzureManagementController::class, "disableAccount"])->name("disableAccount");;
//        Route::put("/enableAccount", [UsersAzureManagementController::class, "enableAccount"])->name("enableAccount");;
//
//    });
//
