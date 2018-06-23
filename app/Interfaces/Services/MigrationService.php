<?php namespace App\Interfaces\Services;

/**
 * Interface for service to apply migrations
 * @package App\Interfaces\Services
 */
interface MigrationService
{
    /**
     * Register migration directory
     *
     * @param string $pathToMigrations
     *
     * @return MigrationService
     */
    public function register(string $pathToMigrations): self;

    /**
     * Publish migrations
     */
    public function publish(): void;
}