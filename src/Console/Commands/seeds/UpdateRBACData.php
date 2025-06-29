<?php

namespace Bhry98\Bhry98LaravelReady\Console\Commands\seeds;

use Bhry98\Bhry98LaravelReady\Database\seeders\core\CoreRBACSeeder;
use Bhry98\Bhry98LaravelReady\Models\users\UsersCoreUsersModel;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;

class UpdateRBACData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bhry98:update-rbac-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'commit update in rbac data without delete any data';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        if ($this->confirm(question: "Start Update All RBAC Data in Database ?", default: true)) {
            Artisan::call(command: "db:seed", parameters: [
                "--class" => CoreRBACSeeder::class
            ]);
            if (Cache::has('permissions')) {
                Cache::forget('permissions');
            }
            Cache::clear();
        }
    }
}
