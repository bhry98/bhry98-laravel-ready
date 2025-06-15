<?php

namespace Bhry98\Bhry98LaravelReady\Providers;

use Bhry98\Bhry98LaravelReady\Console\Commands\seeds\UpdateEnumsData;
use Bhry98\Bhry98LaravelReady\Console\Commands\seeds\UpdateLocationsData;
use Bhry98\Bhry98LaravelReady\Console\Commands\seeds\UpdateRBACData;
use Illuminate\Support\ServiceProvider;

class LaravelCoreCommandsServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->commands(commands: [
            UpdateLocationsData::class,
            UpdateEnumsData::class,
            UpdateRBACData::class,
        ]);
    }
}
