<?php

namespace Bhry98\AccountCenter;

use Illuminate\Support\ServiceProvider;

class Bhry98AccountCenterServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
        self::loadViews();
    }

    private function loadRoutes(): void
    {
        $ds = DIRECTORY_SEPARATOR;
        $this->loadRoutesFrom(bhry98_ac_path("routes{$ds}api.php"));
    }

    private function loadMigrations(): void
    {
        $ds = DIRECTORY_SEPARATOR;
        $this->loadMigrationsFrom(bhry98_ac_path("database{$ds}migrations"));
    }

    private function loadViews(): void
    {
        $ds = DIRECTORY_SEPARATOR;
        $this->loadViewsFrom(bhry98_ac_path("Views"), "AC");
    }
}
