<?php

namespace Bhry98\AccountCenter\Filament\Panels;

use Bhry98\AccountCenter\Filament\Pages\Applications\ApplicationsSwitcher;
use Bhry98\AccountCenter\Filament\Pages\Auth\Bhry98AuthenticationLogin;
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

class Bhry98AccountCenterPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default(config("bhry98.filament.account-center.default", false))
            ->id('account-center')
            ->path('AccountCenter')
            ->login(Bhry98AuthenticationLogin::class)
            ->colors(config("bhry98.filament.account-center.colors", []))
            ->discoverResources(bhry98_ac_path('Filament/Resources'), 'AccountCenter\\Filament\\Resources')
            ->discoverPages(bhry98_ac_path('Filament/Pages'), 'AccountCenter\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
                ApplicationsSwitcher::class,
            ])
            ->discoverWidgets(bhry98_ac_path('Filament/Widgets'), 'AccountCenter\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
            ->brandLogo(config("bhry98.brand_logo"))
            ->brandLogoHeight(config("bhry98.brand_logo_size"))
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
