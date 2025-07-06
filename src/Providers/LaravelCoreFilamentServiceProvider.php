<?php

namespace Bhry98\Bhry98LaravelReady\Providers;

use Bhry98\Bhry98LaravelReady\Filament\locations\Bhry98CountriesResource\Bhry98CountriesResource;
use Bhry98\Bhry98LaravelReady\Filament\locations\Bhry98GovernoratesResource\Bhry98GovernoratesResource;
use Bhry98\Bhry98LaravelReady\Filament\Pages\Applications\ApplicationsSwitcher;
use Bhry98\Bhry98LaravelReady\Filament\Pages\Auth\Bhry98Login;
use Bhry98\Bhry98LaravelReady\Filament\users\Bhry98UsersResource\Bhry98UsersResource;
use Bhry98\Bhry98LaravelReady\Http\Middleware\users\UsersEnsureAdminIsAuth;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\View\PanelsRenderHook;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class LaravelCoreFilamentServiceProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default(config("bhry98.filament.default-panel", true))
            ->id(config("bhry98.filament.panel-name", "center"))
            ->path(config("bhry98.filament.panel-name", "center"))
            ->login(Bhry98Login::class)
//            ->dash
            ->colors([
                'primary' => Color::Sky,
            ])
//            ->resources([
//                Bhry98UsersResource::class,
//                Bhry98CountriesResource::class,
//                Bhry98GovernoratesResource::class
//            ])
            ->plugins([
            ])
            ->topNavigation()
            ->maxContentWidth('full')
//            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
//            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
//            ->discoverClusters(in: app_path('Filament/Clusters'), for: 'App\\Filament\\Clusters')
            ->pages([
                Pages\Dashboard::class,
//                ApplicationsSwitcher::class
            ])
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                UsersEnsureAdminIsAuth::class,
            ]);
    }
}
