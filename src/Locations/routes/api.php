<?php

use Bhry98\Locations\Http\Controllers\LocationsCitiesController;
use Bhry98\Locations\Http\Controllers\LocationsCountriesController;
use Bhry98\Locations\Http\Controllers\LocationsGovernorateController;
use Illuminate\Support\Facades\Route;

Route::name("api.locations")
    ->prefix("api/locations")
    ->middleware(["api", \Bhry98\Helpers\middlewares\SetLocales::class])
    ->group(function () {
        Route::name("countries.")
            ->prefix("countries")
            ->group(function () {
                Route::get("/", [LocationsCountriesController::class, "all"])->name("all");
                Route::get("{countryCode}", [LocationsCountriesController::class, "details"])->name("details");
                Route::get("{countryCode}/governorates", [LocationsCountriesController::class, "allGovernorate"])->name("allGovernorate");
                Route::get("{countryCode}/cities", [LocationsCountriesController::class, "allCities"])->name("allCities");
            });
        Route::name("governorates.")
            ->prefix("governorates")
            ->group(function () {
                Route::get("/", [LocationsGovernorateController::class, "all"])->name("all");
                Route::get("{governorateCode}", [LocationsGovernorateController::class, "details"])->name("details");
                Route::get("{governorateCode}/cities", [LocationsGovernorateController::class, "allCities"])->name("allCities");
            });
        Route::name("cities.")
            ->prefix("cities")
            ->group(function () {
                Route::get("/", [LocationsCitiesController::class, "all"])->name("all");
                Route::get("{cityCode}", [LocationsCitiesController::class, "details"])->name("details");
            });
    });