<?php

namespace Bhry98\Locations\Filament\Panels;

use Bhry98\AccountCenter\Filament\Pages\Applications\ApplicationsSwitcher;
use Bhry98\AccountCenter\Filament\Pages\Auth\Bhry98AuthenticationLogin;
use Bhry98\Locations\Filament\Resources\Bhry98CitiesResource\Bhry98CitiesResource;
use Bhry98\Locations\Filament\Resources\Bhry98CountriesResource\Bhry98CountriesResource;
use Bhry98\Locations\Filament\Resources\Bhry98GovernoratesResource\Bhry98GovernoratesResource;
use Bhry98\Users\Http\Middlewares\UsersEnsureAdminIsAuth;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\MaxWidth;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class Bhry98LocationsPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id(config("bhry98.filament.locations.id"))
            ->path(config("bhry98.filament.locations.path"))
            ->login(Bhry98AuthenticationLogin::class)
            ->colors(config("bhry98.filament.locations.colors", []))
            ->discoverResources(bhry98_users_path('Filament/Resources'), 'Users\\Filament\\Resources')
            ->discoverPages(bhry98_users_path('Filament/Pages'), 'Users\\Filament\\Pages')
            ->discoverWidgets(bhry98_users_path('Filament/Widgets'), 'Users\\Filament\\Widgets')
            ->pages([
                Pages\Dashboard::class,
                ApplicationsSwitcher::class,
            ])
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
            ->resources([
                Bhry98CountriesResource::class,
                Bhry98CitiesResource::class,
                Bhry98GovernoratesResource::class,
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
            ->topNavigation()
            ->maxContentWidth(MaxWidth::Full)
            ->authMiddleware([
                UsersEnsureAdminIsAuth::class,
            ]);
    }
}
