<?php namespace App\Services;

use Illuminate\Support\Facades\File;
use App\Interfaces\Services\MigrationService;

class Migrator implements MigrationService
{
    /**
     * @var array
     */
    private $migrations = [];

    /**
     * Register migration directory
     *
     * @param string $pathToMigrations
     *
     * @return MigrationService
     */
    public function register(string $pathToMigrations): MigrationService
    {
        $this->migrations[] = $pathToMigrations;

        return $this;
    }

    /**
     * Publish migrations
     */
    public function publish(): void
    {
        foreach ($this->migrations as $migration) {
            File::copyDirectory($migration, 'database/migrations');
        }
    }
}