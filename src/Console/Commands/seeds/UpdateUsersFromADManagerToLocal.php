<?php

namespace Bhry98\Bhry98LaravelReady\Console\Commands\seeds;

use Bhry98\Bhry98LaravelReady\Services\users\UsersADManagerManagementService;
use Illuminate\Console\Command;

class UpdateUsersFromADManagerToLocal extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bhry98:update-users-from-ad-manager-to-local';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync All Users From ADManager To Local ad manager users table';
    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->info(string: 'Start Syncing Users From AD Manager To Local ad manager table');
        (new UsersADManagerManagementService())->syncUsersFromADManagerToLocal();
        $this->info(string: 'Finished Syncing Users From Azure AD To Local azure users table');;
    }
}
