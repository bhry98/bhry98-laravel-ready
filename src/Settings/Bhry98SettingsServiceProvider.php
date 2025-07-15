<?php

namespace Bhry98\Settings;

use Illuminate\Support\ServiceProvider;

class Bhry98SettingsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
        self::loadMigrations();
        self::loadRoutes();
    }

    private function loadRoutes(): void
    {
        $ds = DIRECTORY_SEPARATOR;
        $this->loadRoutesFrom(bhry98_settings_path("routes{$ds}api.php"));
    }

    private function loadMigrations(): void
    {
        $ds = DIRECTORY_SEPARATOR;
        $this->loadMigrationsFrom(bhry98_settings_path("database{$ds}migrations"));
    }
}
