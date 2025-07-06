<?php

namespace Bhry98\Bhry98LaravelReady\Filament\Pages\Applications;

use Filament\Facades\Filament;
use Filament\Pages\Page;
use Illuminate\Support\Collection;

class ApplicationsSwitcher extends Page
{

    protected static ?string $navigationIcon = 'heroicon-o-server-stack';

    protected static string $view = 'Bhry98::applications.application-switcher';

    protected static ?string $title = 'Switch Panel';

    public function getPanels(): Collection
    {
        return collect(Filament::getPanels());
    }

    public static function shouldRegisterNavigation(): bool
    {
        return false; // Hide from sidebar
    }
}