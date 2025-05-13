<?php

namespace Bhry98\Bhry98LaravelReady\Http\Controllers\locations;

use Bhry98\Bhry98LaravelReady\Http\Requests\locations\countries\LocationsGetAllCountriesRequest;
use Bhry98\Bhry98LaravelReady\Http\Requests\locations\countries\LocationsGetAllCountryGovernoratesRequest;
use Bhry98\Bhry98LaravelReady\Http\Resources\locations\CountryResource;
use Bhry98\Bhry98LaravelReady\Http\Resources\locations\GovernorateResource;
use Bhry98\Bhry98LaravelReady\Services\locations\CountriesManagementService;
use Exception;
use Illuminate\Http\JsonResponse;
use \App\Http\Controllers\Controller;

class CountriesManagementController extends Controller
{
    function all(LocationsGetAllCountriesRequest $request, CountriesManagementService $countryService): JsonResponse
    {
        try {
            // get all countries by type
            $permissions = $countryService->getAll(
                pageNumber: $request->get(key: 'pageNumber'),
                perPage: $request->get(key: 'perPage'),
                filters: $request->get(key: 'filters')
            );
            if ($permissions->isEmpty()) {
                return bhry98_response_success_without_data(data: CountryResource::collection($permissions)->response()->getData(true));
            }
            return bhry98_response_success_with_data(data: CountryResource::collection($permissions)->response()->getData(true));
        } catch (Exception $e) {
            return bhry98_response_internal_error([
                'error' => $e->getMessage(),
                'code' => $e->getCode(),
                'line' => $e->getLine(),
            ]);
        }
    }

    function allGovernorate(LocationsGetAllCountryGovernoratesRequest $request, CountriesManagementService $countryService): JsonResponse
    {
        try {
            // get all countries by type
            $permissions = $countryService->getAllGovernorates(
                countryCode: $request->get(key: 'countryCode'),
                pageNumber: $request->get(key: 'pageNumber'),
                perPage: $request->get(key: 'perPage'),
                relations: $request->get(key: 'with'),
                filters: $request->get(key: 'filters')
            );
            if ($permissions->isEmpty()) {
                return bhry98_response_success_without_data(data: GovernorateResource::collection($permissions)->response()->getData(true));
            }
            return bhry98_response_success_with_data(data: GovernorateResource::collection($permissions)->response()->getData(true));
        } catch (Exception $e) {
            return bhry98_response_internal_error([
                'error' => $e->getMessage(),
                'code' => $e->getCode(),
                'line' => $e->getLine(),
            ]);
        }
    }
}