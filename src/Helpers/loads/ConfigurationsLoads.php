<?php

namespace Bhry98\Helpers\loads;

use Bhry98\Users\Models\UsersPersonalAccessTokenModel;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Sanctum;

class ConfigurationsLoads extends ServiceProvider
{
    public function boot(): void
    {
        self::sessionsConfig();
        self::authConfig();
    }

    private function sessionsConfig(): void
    {
        Sanctum::usePersonalAccessTokenModel(UsersPersonalAccessTokenModel::class);
    }
    private function authConfig(): void
    {
        config()->set(key: "auth.providers", value: [
            'users' => [
                'driver' => 'eloquent',
                'model' => config('bhry98.user_model'),
            ],
        ]);
    }
}