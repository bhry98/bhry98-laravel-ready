<?php

namespace Bhry98\Bhry98LaravelReady\Console\Commands\seeds;

use Bhry98\Bhry98LaravelReady\Database\seeders\core\LocationsSeeder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class UpdateLocationsData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bhry98:update-locations-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'commit update in locations data without delete any data';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        if ($this->confirm(question: "Start Update All Locations Data in Database ?", default: true)) {
            Artisan::call(command: "db:seed", parameters: [
                "--class" => LocationsSeeder::class
            ]);
        }
    }
}
