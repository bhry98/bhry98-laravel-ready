<?php

namespace Bhry98\Bhry98LaravelReady\Http\Controllers\locations;

use Bhry98\Bhry98LaravelReady\Http\Requests\locations\countries\LocationsGetAllCountriesRequest;
use Bhry98\Bhry98LaravelReady\Http\Requests\locations\countries\LocationsGetAllCountryCitiesRequest;
use Bhry98\Bhry98LaravelReady\Http\Requests\locations\countries\LocationsGetAllCountryGovernoratesRequest;
use Bhry98\Bhry98LaravelReady\Http\Requests\locations\countries\LocationsGetCountryDetailsRequest;
use Bhry98\Bhry98LaravelReady\Http\Resources\locations\CityResource;
use Bhry98\Bhry98LaravelReady\Http\Resources\locations\CountryResource;
use Bhry98\Bhry98LaravelReady\Http\Resources\locations\GovernorateResource;
use Bhry98\Bhry98LaravelReady\Services\locations\CountriesManagementService;
use Exception;
use Illuminate\Http\JsonResponse;
use \App\Http\Controllers\Controller;

class CountriesManagementController extends Controller
{
    /**
     * @param LocationsGetAllCountriesRequest $request
     * @param CountriesManagementService $countryService
     * @return JsonResponse
     */
    public function all(LocationsGetAllCountriesRequest $request, CountriesManagementService $countryService): JsonResponse
    {
        try {
            $data = $countryService->getAll($request->get('pageNumber'), $request->get('perPage'), $request->get('with'), $request->get('filters'));
            if ($data->isEmpty()) return bhry98_response_success_without_data(CountryResource::collection($data)->response()->getData(true));
            return bhry98_response_success_with_data(CountryResource::collection($data)->response()->getData(true));
        } catch (Exception $e) {
            return bhry98_response_internal_error([
                'error' => $e->getMessage(),
                'code' => $e->getCode(),
                'line' => $e->getLine(),
            ]);
        }
    }

    /**
     * @param LocationsGetCountryDetailsRequest $request
     * @param CountriesManagementService $countryService
     * @return JsonResponse
     */
    public function details(LocationsGetCountryDetailsRequest $request, CountriesManagementService $countryService): JsonResponse
    {
        try {
            $data = $countryService->getByCode($request->get('countryCode'), $request->get('with'),true);
            if (!$data) return bhry98_response_success_without_data();
            return bhry98_response_success_with_data(CountryResource::make($data));
        } catch (Exception $e) {
            return bhry98_response_internal_error([
                'error' => $e->getMessage(),
                'code' => $e->getCode(),
                'line' => $e->getLine(),
            ]);
        }
    }

    /**
     * @param LocationsGetAllCountryGovernoratesRequest $request
     * @param CountriesManagementService $countryService
     * @return JsonResponse
     */
    public function allGovernorate(LocationsGetAllCountryGovernoratesRequest $request, CountriesManagementService $countryService): JsonResponse
    {
        try {
            $data = $countryService->getAllGovernorates($request->get('countryCode'), $request->get('pageNumber'), $request->get('perPage'), $request->get('with'), $request->get('filters'));
            if ($data->isEmpty()) return bhry98_response_success_without_data(GovernorateResource::collection($data)->response()->getData(true));
            return bhry98_response_success_with_data(GovernorateResource::collection($data)->response()->getData(true));
        } catch (Exception $e) {
            return bhry98_response_internal_error([
                'error' => $e->getMessage(),
                'code' => $e->getCode(),
                'line' => $e->getLine(),
            ]);
        }
    }

    /**
     * @param LocationsGetAllCountryCitiesRequest $request
     * @param CountriesManagementService $countryService
     * @return JsonResponse
     */
    public function allCities(LocationsGetAllCountryCitiesRequest $request, CountriesManagementService $countryService): JsonResponse
    {
        try {
            $data = $countryService->getAllCities($request->get('countryCode'), $request->get('pageNumber'), $request->get('perPage'), $request->get('with'), $request->get('filters'));
            if ($data->isEmpty()) return bhry98_response_success_without_data(CityResource::collection($data)->response()->getData(true));
            return bhry98_response_success_with_data(CityResource::collection($data)->response()->getData(true));
        } catch (Exception $e) {
            return bhry98_response_internal_error([
                'error' => $e->getMessage(),
                'code' => $e->getCode(),
                'line' => $e->getLine(),
            ]);
        }
    }
}