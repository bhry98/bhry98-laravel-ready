<?php

namespace Bhry98\GP\Filament\Panels;

use Bhry98\AccountCenter\Filament\Pages\Applications\ApplicationsSwitcher;
use Bhry98\AccountCenter\Filament\Pages\Auth\Bhry98AuthenticationLogin;
use Bhry98\GP\Filament\Resources\Bhry98GroupsResource\Bhry98GroupsResource;
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

class Bhry98GroupPoliciesPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id(config("bhry98.filament.group-policies.id",'gp'))
            ->path(config("bhry98.filament.group-policies.path",'GroupPolicies'))
            ->login(Bhry98AuthenticationLogin::class)
            ->colors(config("bhry98.filament.group-policies.colors",[]))
            ->discoverResources(bhry98_gp_path('Filament/Resources'), 'GP\\Filament\\Resources')
            ->discoverPages(bhry98_gp_path('Filament/Pages'), 'GP\\Filament\\Pages')
            ->discoverWidgets(bhry98_gp_path('Filament/Widgets'), 'GP\\Filament\\Widgets')
            ->brandLogo(config("bhry98.brand_logo"))
            ->brandLogoHeight(config("bhry98.brand_logo_size"))
            ->pages([
                Pages\Dashboard::class,
                ApplicationsSwitcher::class,
            ])
            ->resources([
                Bhry98GroupsResource::class
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
            ->topNavigation()
            ->maxContentWidth(MaxWidth::Full)
            ->authMiddleware([
                UsersEnsureAdminIsAuth::class,
            ]);
    }
}
