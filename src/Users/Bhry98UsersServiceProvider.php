<?php

namespace Bhry98\Users;

use Illuminate\Support\ServiceProvider;

class Bhry98UsersServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
        self::loadRoutes();
        self::loadMigrations();
        self::loadViews();
    }

    private function loadRoutes(): void
    {
        $ds = DIRECTORY_SEPARATOR;
        $this->loadRoutesFrom(bhry98_users_path("routes{$ds}api.php"));
    }

    private function loadMigrations(): void
    {
        $ds = DIRECTORY_SEPARATOR;
        $this->loadMigrationsFrom(bhry98_users_path("database{$ds}migrations"));
    }

    private function loadViews(): void
    {
        $ds = DIRECTORY_SEPARATOR;
        $this->loadViewsFrom(bhry98_users_path("Views"), "Users");
    }
}
