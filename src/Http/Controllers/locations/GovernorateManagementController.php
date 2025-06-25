<?php

namespace Bhry98\Bhry98LaravelReady\Http\Controllers\locations;

use Bhry98\Bhry98LaravelReady\Http\Requests\locations\governorates\LocationsGetAllGovernorateCitiesRequest;
use Bhry98\Bhry98LaravelReady\Http\Requests\locations\governorates\LocationsGetAllGovernoratesRequest;
use Bhry98\Bhry98LaravelReady\Http\Requests\locations\governorates\LocationsGetGovernorateDetailsRequest;
use Bhry98\Bhry98LaravelReady\Http\Resources\locations\CityResource;
use Bhry98\Bhry98LaravelReady\Http\Resources\locations\GovernorateResource;
use Bhry98\Bhry98LaravelReady\Services\locations\GovernorateManagementService;
use Exception;
use Illuminate\Http\JsonResponse;
use \App\Http\Controllers\Controller;

class GovernorateManagementController extends Controller
{
    /**
     * @param LocationsGetAllGovernoratesRequest $request
     * @param GovernorateManagementService $governorateService
     * @return JsonResponse
     */
    public function all(LocationsGetAllGovernoratesRequest $request, GovernorateManagementService $governorateService): JsonResponse
    {
        try {
            $data = $governorateService->getAll($request->get('pageNumber'), $request->get('perPage'), $request->get('with'), $request->get('filters'), $request->get('country'));
            if ($data->isEmpty()) {
                return bhry98_response_success_without_data(data: GovernorateResource::collection($data)->response()->getData(true));
            }
            return bhry98_response_success_with_data(data: GovernorateResource::collection($data)->response()->getData(true));
        } catch (Exception $e) {
            return bhry98_response_internal_error([
                'error' => $e->getMessage(),
                'code' => $e->getCode(),
                'line' => $e->getLine(),
            ]);
        }
    }

    /**
     * @param LocationsGetAllGovernorateCitiesRequest $request
     * @param GovernorateManagementService $governorateService
     * @return JsonResponse
     */
    public function allCities(LocationsGetAllGovernorateCitiesRequest $request, GovernorateManagementService $governorateService): JsonResponse
    {
        try {
            $data = $governorateService->getAllCities($request->get('governorateCode'), $request->get('pageNumber'), $request->get('perPage'), $request->get('with'), $request->get('filters'));
            if ($data->isEmpty()) {
                return bhry98_response_success_without_data(data: CityResource::collection($data)->response()->getData(true));
            }
            return bhry98_response_success_with_data(data: CityResource::collection($data)->response()->getData(true));
        } catch (Exception $e) {
            return bhry98_response_internal_error([
                'error' => $e->getMessage(),
                'code' => $e->getCode(),
                'line' => $e->getLine(),
            ]);
        }
    }

    /**
     * @param LocationsGetGovernorateDetailsRequest $request
     * @param GovernorateManagementService $governoratesService
     * @return JsonResponse
     */
    public function details(LocationsGetGovernorateDetailsRequest $request, GovernorateManagementService $governoratesService): JsonResponse
    {
        try {
            $data = $governoratesService->getByCode($request->get('governorateCode'), $request->get('with'));
            if (!$data) return bhry98_response_success_without_data();
            return bhry98_response_success_with_data(GovernorateResource::make($data));
        } catch (Exception $e) {
            return bhry98_response_internal_error([
                'error' => $e->getMessage(),
                'code' => $e->getCode(),
                'line' => $e->getLine(),
            ]);
        }
    }

}