<?php

namespace Bhry98\Helpers\loads;

use BezhanSalleh\FilamentLanguageSwitch\LanguageSwitch;
use Bhry98\AccountCenter\Filament\Pages\Applications\ApplicationsSwitcher;
use Bhry98\AccountCenter\Filament\Panels\Bhry98AccountCenterPanelProvider;
use Bhry98\GP\Filament\Panels\Bhry98GroupPoliciesPanelProvider;
use Bhry98\Locations\Filament\Panels\Bhry98LocationsPanelProvider;
use Bhry98\Users\Filament\Panels\Bhry98UsersPanelProvider;
use Filament\Facades\Filament;
use Filament\Panel;
use Filament\View\PanelsRenderHook;
use Illuminate\Support\ServiceProvider;

class FilamentLoads extends ServiceProvider
{
    public function boot(): void
    {
        self::LanguageSwitcher();
        self::multiplePanels();
    }

    private function LanguageSwitcher(): void
    {
        LanguageSwitch::configureUsing(function (LanguageSwitch $switch) {
            $switch->visible(outsidePanels: true)->locales(config("bhry98.locales", ['ar', 'en']));
        });
    }

    private function multiplePanels(): void
    {
        if (config("bhry98.filament.multiple-panels", false)) {
            collect(Filament::getPanels())->map(fn(Panel $panel) => $panel->pages([ApplicationsSwitcher::class])->renderHook(PanelsRenderHook::USER_MENU_BEFORE, fn() => view('AC::applications.application-switcher-btn')));
        }
    }

}