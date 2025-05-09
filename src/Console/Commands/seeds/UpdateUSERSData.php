<?php

namespace Bhry98\Bhry98LaravelReady\Console\Commands\seeds;

use Bhry98\Bhry98LaravelReady\Database\seeders\users\UsersOldSeeder;
use Bhry98\Bhry98LaravelReady\Database\seeders\core\CoreRBACSeeder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class UpdateUSERSData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bhry98:update-users-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'commit update in users data without delete any data';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        if ($this->confirm(question: "Start Update All UsersOldSeeder Data in Database ?", default: true)) {
            Artisan::call(command: "db:seed", parameters: [
                "--class" => UsersOldSeeder::class
            ]);
        }
    }
}
