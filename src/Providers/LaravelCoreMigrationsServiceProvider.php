<?php

namespace Bhry98\Bhry98LaravelReady\Providers;

use Illuminate\Support\ServiceProvider;

class LaravelCoreMigrationsServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $ds = DIRECTORY_SEPARATOR;
        $this->loadMigrationsFrom(paths: [
            __DIR__ . "$ds..{$ds}Database{$ds}migrations{$ds}cache",
            __DIR__ . "$ds..{$ds}Database{$ds}migrations{$ds}enums",
            __DIR__ . "$ds..{$ds}Database{$ds}migrations{$ds}identities",
            __DIR__ . "$ds..{$ds}Database{$ds}migrations{$ds}localizations",
            __DIR__ . "$ds..{$ds}Database{$ds}migrations{$ds}locations",
            __DIR__ . "$ds..{$ds}Database{$ds}migrations{$ds}logs",
            __DIR__ . "$ds..{$ds}Database{$ds}migrations{$ds}queue",
            __DIR__ . "$ds..{$ds}Database{$ds}migrations{$ds}rbac",
            __DIR__ . "$ds..{$ds}Database{$ds}migrations{$ds}sessions",
            __DIR__ . "$ds..{$ds}Database{$ds}migrations{$ds}users",
            __DIR__ . "$ds..{$ds}Database{$ds}migrations{$ds}settings",
        ]);
    }
}
