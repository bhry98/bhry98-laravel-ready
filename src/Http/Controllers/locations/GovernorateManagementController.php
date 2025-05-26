<?php

namespace Bhry98\Bhry98LaravelReady\Http\Controllers\locations;

use Bhry98\Bhry98LaravelReady\Http\Requests\locations\countries\LocationsGetAllCountriesRequest;
use Bhry98\Bhry98LaravelReady\Http\Requests\locations\countries\LocationsGetAllCountryCitiesRequest;
use Bhry98\Bhry98LaravelReady\Http\Requests\locations\countries\LocationsGetAllCountryGovernoratesRequest;
use Bhry98\Bhry98LaravelReady\Http\Requests\locations\countries\LocationsGetCountryDetailsRequest;
use Bhry98\Bhry98LaravelReady\Http\Requests\locations\governorates\LocationsGetAllGovernoratesByGlobalCountryCodeRequest;
use Bhry98\Bhry98LaravelReady\Http\Requests\locations\governorates\LocationsGetAllGovernoratesRequest;
use Bhry98\Bhry98LaravelReady\Http\Resources\locations\CityResource;
use Bhry98\Bhry98LaravelReady\Http\Resources\locations\CountryResource;
use Bhry98\Bhry98LaravelReady\Http\Resources\locations\GovernorateResource;
use Bhry98\Bhry98LaravelReady\Services\locations\CountriesManagementService;
use Bhry98\Bhry98LaravelReady\Services\locations\GovernorateManagementService;
use Exception;
use Illuminate\Http\JsonResponse;
use \App\Http\Controllers\Controller;

class GovernorateManagementController extends Controller
{
    function all(LocationsGetAllGovernoratesRequest $request, GovernorateManagementService $governorateService): JsonResponse
    {
        try {
            // get all countries by type
            $permissions = $governorateService->getAll(
                pageNumber: $request->get(key: 'pageNumber'),
                perPage: $request->get(key: 'perPage'),
                relations: $request->get(key: 'with'),
                filters: $request->get(key: 'filters'),
                countryGlobalCode: $request->get(key: 'country'),
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