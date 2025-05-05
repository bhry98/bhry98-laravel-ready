<?php

namespace Bhry98\Bhry98LaravelReady\Commands;

use Bhry98\LaravelUsersCore\Database\Seeders\UsersCoreCountriesSeeder;
use Bhry98\LaravelUsersCore\Database\Seeders\UsersCoreTypesSeeder;
use Illuminate\Console\Command;

class Bhry98LaravelReadySeedDefaultCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bhry98-laravel-ready:seed-all-defaults';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add all default package data [users,countries,cities,...etc]';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        $this->line("starting seeding");
        $this->call('db:seed', ['--class' => UsersCoreTypesSeeder::class]);
        $this->call('db:seed', ['--class' => UsersCoreCountriesSeeder::class]);
        $this->info("seeded successfully");
    }

}