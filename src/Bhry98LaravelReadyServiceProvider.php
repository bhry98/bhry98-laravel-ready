<?php

namespace Bhry98;

use Bhry98\GP\Bhry98GroupPoliciesServiceProvider;
use Bhry98\Helpers\loads\ConfigurationsLoads;
use Bhry98\Locations\Bhry98LocationsServiceProvider;
use Bhry98\Settings\Bhry98SettingsServiceProvider;
use Bhry98\Users\Bhry98UsersServiceProvider;
use Illuminate\Support\ServiceProvider;

class Bhry98LaravelReadyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(bhry98_config_path("bhry98.php"), 'bhry98');
//        $this->app->singleton(abstract: ExceptionHandler::class, concrete: HandlerUnAuthenticatedException::class);
//        $this->app->bind(Notification::class, UsersNotificationsModel::class);
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
        self::loadTranslations();
        self::loadMigrations();
        $this->app->register(ConfigurationsLoads::class);


//        $this->app->register(LaravelCoreMigrationsServiceProvider::class);
//        $this->app->register(LaravelCoreCommandsServiceProvider::class);
//        LanguageSwitch::configureUsing(function (LanguageSwitch $switch) {
//            $switch
////                ->circular()
//                ->visible(outsidePanels: true)
//                ->locales(['ar', 'en']);
//        });
//        self::loadRoutes();
//        self::loadFilamentViews();
////        $this->app->register(LaravelCoreConfigServiceProvider::class);
//        LaravelCoreConfigLoad::load();
//        try {
//            DB::connection()->getPdo();
//            $this->app->register(LaravelCoreAuthServiceProvider::class);
//
//        } catch (Throwable) {
//        }
//        $this->publishes([
//            __DIR__ . '/Config/bhry98.php' => config_path('bhry98.php'),
//        ]);
//        dd(config('mail.mailers.smtp'));
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
