<?php

namespace Bhry98\Bhry98LaravelReady;

use BezhanSalleh\FilamentLanguageSwitch\LanguageSwitch;
use Bhry98\Bhry98LaravelReady\Exceptions\HandlerUnAuthenticatedException;
use Bhry98\Bhry98LaravelReady\Helpers\loads\LaravelCoreConfigLoad;
use Bhry98\Bhry98LaravelReady\Helpers\loads\LaravelCoreMigrationsLoad;
use Bhry98\Bhry98LaravelReady\Models\sessions\SessionsPersonalAccessTokenModel;
use Bhry98\Bhry98LaravelReady\Models\users\UsersNotificationsModel;
use Bhry98\Bhry98LaravelReady\Providers\LaravelCoreAuthServiceProvider;
use Bhry98\Bhry98LaravelReady\Providers\LaravelCoreCommandsServiceProvider;
use Bhry98\Bhry98LaravelReady\Providers\LaravelCoreConfigServiceProvider;
use Bhry98\Bhry98LaravelReady\Providers\LaravelCoreMigrationsServiceProvider;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Sanctum;
use Throwable;

class Bhry98LaravelReadyServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $ds = DIRECTORY_SEPARATOR;
        $this->mergeConfigFrom(path: __DIR__ . "{$ds}Config{$ds}bhry98.php", key: 'bhry98');
        $this->app->singleton(abstract: ExceptionHandler::class, concrete: HandlerUnAuthenticatedException::class);
        $this->app->bind(Notification::class, UsersNotificationsModel::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->register(LaravelCoreMigrationsServiceProvider::class);
        $this->app->register(LaravelCoreCommandsServiceProvider::class);
        LanguageSwitch::configureUsing(function (LanguageSwitch $switch) {
            $switch
//                ->circular()
                ->visible(outsidePanels: true)
                ->locales(['ar','en']);
        });
        self::loadRoutes();
        self::loadTranslations();
        self::loadFilamentViews();
//        $this->app->register(LaravelCoreConfigServiceProvider::class);
        LaravelCoreConfigLoad::load();
        try {
            DB::connection()->getPdo();
            Sanctum::usePersonalAccessTokenModel(model: SessionsPersonalAccessTokenModel::class);
            $this->app->register(LaravelCoreAuthServiceProvider::class);

        } catch (Throwable) {
        }
        $this->publishes([
            __DIR__ . '/Config/bhry98.php' => config_path('bhry98.php'),
        ]);
//        dd(config('mail.mailers.smtp'));
    }

    function loadRoutes(): void
    {
        $ds = DIRECTORY_SEPARATOR;
        $this->loadRoutesFrom(path: __DIR__ . "{$ds}Routes{$ds}api.php");
    }

    function loadTranslations(): void
    {
        $ds = DIRECTORY_SEPARATOR;
        $this->loadTranslationsFrom(path: __DIR__ . "{$ds}Locales", namespace: "Bhry98");
    }

    function loadFilamentViews(): void
    {
        $ds = DIRECTORY_SEPARATOR;
        $this->loadViewsFrom(__DIR__ . "{$ds}Filament{$ds}Views", namespace: "Bhry98");
        $this->loadViewsFrom(__DIR__ . "{$ds}Filament{$ds}users{$ds}Bhry98UsersResource{$ds}Views", namespace: "Bhry98UsersResource");
    }

}