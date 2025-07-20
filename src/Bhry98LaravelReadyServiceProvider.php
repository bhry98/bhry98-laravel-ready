<?php

namespace Bhry98;

use BezhanSalleh\FilamentLanguageSwitch\LanguageSwitch;
use Bhry98\AccountCenter\Bhry98AccountCenterServiceProvider;
use Bhry98\AccountCenter\Filament\Pages\Applications\ApplicationsSwitcher;
use Bhry98\AccountCenter\Filament\Panels\Bhry98AccountCenterPanelProvider;
use Bhry98\GP\Bhry98GroupPoliciesServiceProvider;
use Bhry98\Helpers\commands\RefreshApplicationDatabase;
use Bhry98\Helpers\loads\ConfigurationsLoads;
use Bhry98\Helpers\loads\HandlerUnAuthenticatedException;
use Bhry98\Locations\Bhry98LocationsServiceProvider;
use Bhry98\Settings\Bhry98SettingsServiceProvider;
use Bhry98\Users\Bhry98UsersServiceProvider;
use Bhry98\Users\Filament\Panels\Bhry98UsersPanelProvider;
use Filament\Facades\Filament;
use Filament\View\PanelsRenderHook;
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
        $this->app->register(Bhry98AuthServiceProvider::class);
        $this->app->register(Bhry98AccountCenterServiceProvider::class);
        // filament panels
//        $this->app->register(Bhry98AccountCenterPanelProvider::class);
//        $this->app->register(Bhry98UsersPanelProvider::class);
        self::loadTranslations();
        self::loadMigrations();
        $this->app->register(ConfigurationsLoads::class);


//        $this->app->register(LaravelCoreMigrationsServiceProvider::class);
//        $this->app->register(LaravelCoreCommandsServiceProvider::class);
        LanguageSwitch::configureUsing(function (LanguageSwitch $switch) {
            $switch
                ->visible(outsidePanels: true)
                ->locales(['ar', 'en']);
        });
        $this->commands([
            RefreshApplicationDatabase::class,
        ]);
        foreach (Filament::getPanels() as $panel) {
//            if ($panel->getId() == "GroupPolicies") dd($panel->getId());
            $panel->pages([
                ApplicationsSwitcher::class
            ])
                ->renderHook(
                    PanelsRenderHook::USER_MENU_BEFORE,
                    fn() => view('AC::applications.application-switcher-btn')
                )
//                ->renderHook(
//                    PanelsRenderHook::TOPBAR_START,
//                    fn() => $panel->getBrandName()
//                )
                //
            ;
        }

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
