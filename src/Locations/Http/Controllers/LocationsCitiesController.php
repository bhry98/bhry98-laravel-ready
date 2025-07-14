<?php

namespace Bhry98\Locations\Http\Controllers;
use Bhry98\Locations\Http\Requests\cities\LocationsGetAllCitiesRequest;
use Bhry98\Locations\Http\Requests\cities\LocationsGetCityDetailsRequest;
use Bhry98\Locations\Http\Resources\CityResource;
use Bhry98\Locations\Services\LocationsCitiesService;
use Exception;
use Illuminate\Http\JsonResponse;
use \App\Http\Controllers\Controller;

class LocationsCitiesController extends Controller
{
    /**
     *  Get All Locations Cities
     *
     * @param LocationsGetAllCitiesRequest $request
     * @param LocationsCitiesService $cityService
     * @return JsonResponse
     */
    public function all(LocationsGetAllCitiesRequest $request, LocationsCitiesService $cityService): JsonResponse
    {
        try {
            $data = $cityService->getAll($request->get('pageNumber'), $request->get('perPage'), $request->get('with'), $request->get('filters'));
            if ($data->isEmpty()) {
                return bhry98_response_success_without_data(CityResource::collection($data)->response()->getData(true));
            }
            return bhry98_response_success_with_data(CityResource::collection($data)->response()->getData(true));
        } catch (Exception $e) {
            return bhry98_response_internal_error([
                'error' => $e->getMessage(),
                'code' => $e->getCode(),
                'line' => $e->getLine(),
            ]);
        }
    }
    /**
     * Get City Details By Code
     *
     * @param LocationsGetCityDetailsRequest $request
     * @param LocationsCitiesService $cityService
     * @return JsonResponse
     */
    public function details(LocationsGetCityDetailsRequest $request, LocationsCitiesService $cityService): JsonResponse
    {
        try {
            $data = $cityService->getByCode($request->get('cityCode'), $request->get('with'));
            if (!$data) return bhry98_response_success_without_data();
            return bhry98_response_success_with_data(CityResource::make($data));
        } catch (Exception $e) {
            return bhry98_response_internal_error([
                'error' => $e->getMessage(),
                'code' => $e->getCode(),
                'line' => $e->getLine(),
            ]);
        }
    }

}