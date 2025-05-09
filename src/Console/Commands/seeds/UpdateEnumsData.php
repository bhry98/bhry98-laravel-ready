<?php

namespace Bhry98\Bhry98LaravelReady\Console\Commands\seeds;

use Bhry98\Bhry98LaravelReady\Database\seeders\core\CoreEnumsSeeder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class UpdateEnumsData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bhry98:update-enums-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'commit update in enums data without delete any data';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        if ($this->confirm(question: "Start Update All Enums Data in Database ?", default: true)) {
            Artisan::call(command: "db:seed", parameters: [
                "--class" => CoreEnumsSeeder::class
            ]);
        }
    }
}
