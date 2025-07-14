<?php

namespace Bhry98\Helpers\loads;

use Illuminate\Support\ServiceProvider;

class MigrationsLoads extends ServiceProvider
{
    public function boot(): void
    {
        $this->localizationsTables();
        $this->enumsTables();
        $this->queueTables();
        $this->queueLocations();
    }

    public function localizationsTables(): void
    {
        $this->loadMigrationsFrom(bhry98_database_path('migrations/localizations'));
    }

    public function enumsTables(): void
    {
        $this->loadMigrationsFrom(bhry98_database_path('migrations/enums'));
    }

    public function queueTables(): void
    {
        $this->loadMigrationsFrom(bhry98_database_path('migrations/queue'));
    }
    public function queueLocations(): void
    {
        $this->loadMigrationsFrom(bhry98_database_path('migrations/locations'));
    }
}