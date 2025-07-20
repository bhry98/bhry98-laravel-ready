<?php

namespace Bhry98\AccountCenter\Filament\Pages\Applications;

use Filament\Facades\Filament;
use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Collection;

class ApplicationsSwitcher extends Page
{

    protected static ?string $navigationIcon = 'heroicon-o-server-stack';

    protected static string $view = 'AC::applications.application-switcher';

    public function getTitle(): string|Htmlable
    {
        return __("Bhry98::global.switch-portals");
    }

    public function getPanels(): Collection
    {
        return collect(Filament::getPanels());
    }

    public static function shouldRegisterNavigation(): bool
    {
        return false; // Hide from sidebar
    }
}