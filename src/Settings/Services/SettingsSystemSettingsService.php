<?php

namespace Bhry98\Settings\Services;

use Bhry98\Helpers\extends\BaseService;
use Rawilk\Settings\Facades\Settings;

class SettingsSystemSettingsService extends BaseService
{
    public function getByKey(string $key)
    {
        return Settings::get($key);
    }
}
