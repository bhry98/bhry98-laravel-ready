<?php

namespace Bhry98\Settings\Http\Controllers;

use Bhry98\Helpers\extends\BaseController;
use Bhry98\Settings\Http\Requests\SettingsEnumsGetAllByTypeRequest;
use Bhry98\Settings\Http\Resources\EnumsResource;
use Bhry98\Settings\Services\SettingsEnumsService;
use Exception;
use Illuminate\Http\JsonResponse;

class SettingsEnumsController extends BaseController
{
    function allByType(SettingsEnumsGetAllByTypeRequest $request, SettingsEnumsService $enumService): JsonResponse
    {
        try {
            // get all enums by type
//            dd($request->validated());
            $permissions = $enumService->getAllByType($request->get('type'), $request->get('pageNumber'), $request->get('perPage'), $request->get('with'),$request->get('filters'));
            if ($permissions->isEmpty()) {
                return bhry98_response_success_without_data(EnumsResource::collection($permissions)->response()->getData(true));
            }
            return bhry98_response_success_with_data(EnumsResource::collection($permissions)->response()->getData(true));
        } catch (Exception $e) {
            return bhry98_response_internal_error([
                'error' => $e->getMessage(),
                'code' => $e->getCode(),
                'line' => $e->getLine(),
            ]);
        }
    }
}