<?php namespace App\Interfaces\Services;

/**
 * Interface for service to publish resources
 * @package App\Interfaces\Services
 */
interface PublishService
{
    /**
     * Register resource
     *
     * @param string $subsystemAlias
     * @param string $dirToPublish
     *
     * @return PublishService
     */
    public function register(string $subsystemAlias, string $dirToPublish): self;

    /**
     * Publish all resources
     */
    public function publish(): void;
}