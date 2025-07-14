<?php

namespace Bhry98\Bhry98LaravelReady\Console\Commands\seeds;

use Bhry98\Bhry98LaravelReady\Database\seeders\core\CoreEnumsSeeder;
use Bhry98\Bhry98LaravelReady\Database\seeders\core\LocationsSeeder;
use Bhry98\Bhry98LaravelReady\Database\seeders\core\CoreRBACSeeder;
use Bhry98\Bhry98LaravelReady\Database\seeders\users\UsersDefaultAdministrator;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class RefreshDatabaseData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bhry98:refresh-database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'drop all tables and seed fresh default data';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        if ($this->confirm("Start Refresh all tables and Data in Database ?")) {
            $this->line("start drop to refresh database");
            Artisan::call("migrate:fresh");
            $this->info("Database is clean now");
            $this->line("start seed default data");
            $this->info("start seed Enums data");
            Artisan::call("db:seed", ["--class" => CoreEnumsSeeder::class]);
            $this->info("start seed Locations data");
            Artisan::call("db:seed", ["--class" => LocationsSeeder::class]);
            $this->info("start seed RBAC data");
            Artisan::call("db:seed", ["--class" => CoreRBACSeeder::class]);
            $this->info("start seed Administrator user");
            Artisan::call("db:seed", ["--class" => UsersDefaultAdministrator::class]);
            $this->info("database is fresh now with default data");
        }
    }
}
