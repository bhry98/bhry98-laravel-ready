<?php

use Bhry98\Settings\Http\Controllers\SettingsEnumsController;
use Bhry98\Settings\Http\Controllers\SystemSettingsController;
use Illuminate\Support\Facades\Route;

Route::name("api")
    ->prefix("api")
    ->middleware(["api", \Bhry98\Helpers\middlewares\SetLocales::class])
    ->group(function () {
        Route::name("enums.")
            ->prefix("enums")
            ->group(function () {
                Route::get("{enumType}", [SettingsEnumsController::class, "allByType"])->name("allByType");
            });
        Route::name("system.")
            ->prefix("system")
            ->group(function () {
                Route::get("settings/{settingKey}", [SystemSettingsController::class, "getByKey"])->name("getByKey");
            });
    });