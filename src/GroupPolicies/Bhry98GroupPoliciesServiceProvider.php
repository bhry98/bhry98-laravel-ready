<?php

namespace Bhry98\GP;

use Illuminate\Support\ServiceProvider;

class Bhry98GroupPoliciesServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->loadMigrations();
        $this->loadView();
    }

    private function loadRoutes(): void
    {
        $ds = DIRECTORY_SEPARATOR;
        $this->loadMigrationsFrom(bhry98_gp_path("routes{$ds}api.php"));
    }

    private function loadMigrations(): void
    {
        $ds = DIRECTORY_SEPARATOR;
        $this->loadMigrationsFrom(bhry98_gp_path("database{$ds}migrations"));
    }
    private function loadView(): void
    {
        $ds = DIRECTORY_SEPARATOR;
        $this->loadViewsFrom(bhry98_gp_path("Views"),"GP");
    }


}
