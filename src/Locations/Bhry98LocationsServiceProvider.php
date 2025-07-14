<?php

namespace Bhry98\Locations;

use Illuminate\Support\ServiceProvider;

class Bhry98LocationsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
        self::loadRoutes();
        self::loadMigrations();
    }

    function loadRoutes(): void
    {
        $ds = DIRECTORY_SEPARATOR;
        $this->loadRoutesFrom(bhry98_locations_path("routes{$ds}api.php"));
    }

    private function loadMigrations(): void
    {
        $ds = DIRECTORY_SEPARATOR;
        $this->loadMigrationsFrom(bhry98_locations_path("database{$ds}migrations"));
    }
}
