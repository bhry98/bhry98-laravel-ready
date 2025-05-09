<?php

namespace Bhry98\Bhry98LaravelReady\Http\Controllers\enums;

use Bhry98\Bhry98LaravelReady\Http\Requests\enums\management\EnumsGetAllByTypeRequest;
use Bhry98\Bhry98LaravelReady\Http\Resources\core\enums\EnumsResource;
use Bhry98\Bhry98LaravelReady\Services\enums\EnumsManagementService;
use Exception;
use Illuminate\Http\JsonResponse;
use \App\Http\Controllers\Controller;
class EnumsManagementController extends Controller
{
    function allByType(EnumsGetAllByTypeRequest $request, EnumsManagementService $enumService): JsonResponse
    {
        try {
            // get all enums by type
            $permissions = $enumService->getAllByType(
                type: $request->get(key: 'type'),
                module: $request->get(key: 'module'),
                pageNumber: $request->get(key: 'pageNumber'),
                perPage: $request->get(key: 'perPage'),
                filters: $request->get(key: 'filters')
            );
            if ($permissions->isEmpty()) {
                return bhry98_response_success_without_data(data: EnumsResource::collection($permissions)->response()->getData(true));
            }
            return bhry98_response_success_with_data(data: EnumsResource::collection($permissions)->response()->getData(true));
        } catch (Exception $e) {
            return bhry98_response_internal_error([
                'error' => $e->getMessage(),
                'code' => $e->getCode(),
                'line' => $e->getLine(),
            ]);
        }
    }
}