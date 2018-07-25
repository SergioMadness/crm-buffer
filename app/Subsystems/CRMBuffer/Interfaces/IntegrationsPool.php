<?php namespace App\Subsystems\CRMBuffer\Interfaces;

/**
 * Interface for integrations pool
 * @package App\Interfaces\Services
 */
interface IntegrationsPool
{
    /**
     * Register integration
     *
     * @param string $alias
     *
     * @return IntegrationsPool
     */
    public function registerIntegration(string $alias): self;

    /**
     * Get integration list
     *
     * @return array
     */
    public function getIntegrations(): array;
}