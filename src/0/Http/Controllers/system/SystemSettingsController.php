<?php

namespace Bhry98\Bhry98LaravelReady\Http\Controllers\system;

use Bhry98\Bhry98LaravelReady\Http\Requests\system\settings\SystemSettingsGetByKeyRequest;
use Bhry98\Bhry98LaravelReady\Services\system\SystemSettingsManagementService;
use Exception;
use Illuminate\Http\JsonResponse;
use \App\Http\Controllers\Controller;

class SystemSettingsController extends Controller
{
    public function getByKey(SystemSettingsGetByKeyRequest $request, SystemSettingsManagementService $settingService): JsonResponse
    {
        try {
            // get all enums by type
            $data = $settingService->getByKey($request->validated('key'));
            if (!$data) {
                return bhry98_response_success_without_data(['value'=>$data]);
            }
            return bhry98_response_success_with_data(['value'=>$data]);
        } catch (Exception $e) {
            return bhry98_response_internal_error([
                'error' => $e->getMessage(),
                'code' => $e->getCode(),
                'line' => $e->getLine(),
            ]);
        }
    }
}