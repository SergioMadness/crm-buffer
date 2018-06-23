<?php namespace App\Traits;

use App\Interfaces\Services\PublishService;
use App\Interfaces\Services\MigrationService;

trait Subsystem
{
    /**
     * @param string $pathToFile
     *
     * @return self
     */
    protected function loadRoutes(string $pathToFile): self
    {
        include $pathToFile;

        return $this;
    }

    /**
     * Add path to migrations
     *
     * @param string $pathToMigrations
     *
     * @return self
     */
    protected function addMigrations(string $pathToMigrations): self
    {
        /** @var MigrationService $service */
        $service = app(MigrationService::class);
        $service->register($pathToMigrations);

        return $this;
    }

    /**
     * Add path to resources
     *
     * @param string $alias
     * @param string $pathToDir
     *
     * @return self
     */
    protected function publish(string $alias, string $pathToDir): self
    {
        /** @var PublishService $service */
        $service = app(PublishService::class);
        $service->register($alias, $pathToDir);

        return $this;
    }
}