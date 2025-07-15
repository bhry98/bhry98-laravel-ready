<?php

namespace Bhry98\Settings\Http\Controllers;


use Bhry98\Helpers\extends\BaseController;
use Bhry98\Settings\Http\Requests\SettingsSystemGetSettingByKeyRequest;
use Bhry98\Settings\Services\SettingsSystemSettingsService;
use Exception;
use Illuminate\Http\JsonResponse;

class SystemSettingsController extends BaseController
{
    public function getByKey(SettingsSystemGetSettingByKeyRequest $request, SettingsSystemSettingsService $settingService): JsonResponse
    {
        try {
            // get all enums by type
            $data = $settingService->getByKey($request->validated('key'));
            if (!$data) {
                return bhry98_response_success_without_data(['value' => $data]);
            }
            return bhry98_response_success_with_data(['value' => $data]);
        } catch (Exception $e) {
            return bhry98_response_internal_error([
                'error' => $e->getMessage(),
                'code' => $e->getCode(),
                'line' => $e->getLine(),
            ]);
        }
    }
}