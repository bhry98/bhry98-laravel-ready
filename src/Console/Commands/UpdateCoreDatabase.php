<?php
namespace Bhry98\Bhry98LaravelReady\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class UpdateCoreDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bhry98:update-core-database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'commit update in core database';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        if ($this->confirm(question: "Start Delete All Tables in Database ?",default: true)) {
            Artisan::call(command: "migrate:fresh", parameters: [
                "--database" => "core"
            ]);
        }
    }
}
