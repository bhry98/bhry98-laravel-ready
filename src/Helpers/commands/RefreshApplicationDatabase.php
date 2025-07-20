<?php

namespace Bhry98\Helpers\commands;

use Bhry98\GP\database\seeders\GPSeeder;
use Bhry98\Locations\database\seeders\LocationsSeeder;
use Bhry98\Users\database\seeders\UsersDefaultAdministrator;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class RefreshApplicationDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bhry98:refresh-application-database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->output->title('Refreshing application database...');
        Artisan::call('migrate:fresh --seed');
        Artisan::call('db:seed', [
            "--class" => GPSeeder::class
        ]);
        Artisan::call('db:seed', [
            "--class" => LocationsSeeder::class
        ]);
        Artisan::call('db:seed', [
            "--class" => UsersDefaultAdministrator::class
        ]);
        Artisan::call('optimize:clear');
        $this->output->success('Application database refreshed successfully.');
    }
}
