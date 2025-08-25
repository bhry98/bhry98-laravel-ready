<?php

namespace Bhry98;

use Bhry98\AccountCenter\Bhry98AccountCenterServiceProvider;
use Bhry98\AccountCenter\Filament\Panels\Bhry98AccountCenterPanelProvider;
use Bhry98\GP\Bhry98GroupPoliciesServiceProvider;
use Bhry98\GP\Filament\Panels\Bhry98GroupPoliciesPanelProvider;
use Bhry98\Helpers\commands\RefreshApplicationDatabase;
use Bhry98\Helpers\loads\ConfigurationsLoads;
use Bhry98\Helpers\loads\FilamentLoads;
use Bhry98\Helpers\loads\HandlerUnAuthenticatedException;
use Bhry98\Locations\Bhry98LocationsServiceProvider;
use Bhry98\Locations\Filament\Panels\Bhry98LocationsPanelProvider;
use Bhry98\Settings\Bhry98SettingsServiceProvider;
use Bhry98\Users\Bhry98UsersServiceProvider;
use Bhry98\Users\Filament\Panels\Bhry98UsersPanelProvider;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Support\ServiceProvider;

class Bhry98LaravelReadyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(bhry98_config_path("bhry98.php"), 'bhry98');
        $this->app->singleton(ExceptionHandler::class, HandlerUnAuthenticatedException::class);
        if (config("bhry98.filament.multiple-panels", false)) {
            $this->app->register(Bhry98AccountCenterPanelProvider::class);
            $this->app->register(Bhry98LocationsPanelProvider::class);
            $this->app->register(Bhry98UsersPanelProvider::class);
            $this->app->register(Bhry98GroupPoliciesPanelProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->register(Bhry98UsersServiceProvider::class);
        $this->app->register(Bhry98SettingsServiceProvider::class);
        $this->app->register(Bhry98GroupPoliciesServiceProvider::class);
        $this->app->register(Bhry98LocationsServiceProvider::class);
        $this->app->register(Bhry98AuthServiceProvider::class);
        $this->app->register(Bhry98AccountCenterServiceProvider::class);

        self::loadTranslations();
        self::loadMigrations();
        $this->app->register(ConfigurationsLoads::class);
        $this->app->register(FilamentLoads::class);
        $this->commands([
            RefreshApplicationDatabase::class,
        ]);
    }
    private function loadTranslations(): void
    {
        $this->loadTranslationsFrom(bhry98_base_path("Locales"), "Bhry98");
    }
    private function loadMigrations(): void
    {
        $ds = DIRECTORY_SEPARATOR;
        $this->loadMigrationsFrom(bhry98_base_path("Helpers{$ds}migrations"));
    }
}
