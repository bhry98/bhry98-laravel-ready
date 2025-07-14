<?php

namespace Bhry98\Locations\Http\Controllers;

use Bhry98\Locations\Http\Requests\countries\LocationsGetAllCountriesRequest;
use Bhry98\Locations\Http\Requests\countries\LocationsGetAllCountryCitiesRequest;
use Bhry98\Locations\Http\Requests\countries\LocationsGetAllCountryGovernoratesRequest;
use Bhry98\Locations\Http\Requests\countries\LocationsGetCountryDetailsRequest;
use Bhry98\Locations\Http\Resources\CityResource;
use Bhry98\Locations\Http\Resources\CountryResource;
use Bhry98\Locations\Http\Resources\GovernorateResource;
use Bhry98\Locations\Services\LocationsCountriesService;
use Exception;
use Illuminate\Http\JsonResponse;
use \App\Http\Controllers\Controller;

class LocationsCountriesController extends Controller
{
    /**
     * @param LocationsGetAllCountriesRequest $request
     * @param LocationsCountriesService $countryService
     * @return JsonResponse
     */
    public function all(LocationsGetAllCountriesRequest $request, LocationsCountriesService $countryService): JsonResponse
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
     * @param LocationsCountriesService $countryService
     * @return JsonResponse
     */
    public function details(LocationsGetCountryDetailsRequest $request, LocationsCountriesService $countryService): JsonResponse
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
     * @param LocationsCountriesService $countryService
     * @return JsonResponse
     */
    public function allGovernorate(LocationsGetAllCountryGovernoratesRequest $request, LocationsCountriesService $countryService): JsonResponse
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
     * @param LocationsCountriesService $countryService
     * @return JsonResponse
     */
    public function allCities(LocationsGetAllCountryCitiesRequest $request, LocationsCountriesService $countryService): JsonResponse
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