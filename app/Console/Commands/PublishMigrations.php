<?php namespace App\Console\Commands;

use App\Interfaces\Services\MigrationService;
use Illuminate\Console\Command;
use App\Interfaces\Services\PublishService;

class PublishMigrations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'publish:migrations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish migrations';

    /**
     * Execute the console command.
     *
     * @param MigrationService $migrationsService
     *
     * @return mixed
     */
    public function handle(MigrationService $migrationsService)
    {
        $migrationsService->publish();

        return true;
    }
}