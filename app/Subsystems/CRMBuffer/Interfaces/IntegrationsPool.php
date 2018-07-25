<?php namespace App\Subsystems\CRMBuffer\Interfaces;

use App\Subsystems\CRMBuffer\Interfaces\Models\Integration;


/**
 * Interface for integrations pool
 * @package App\Interfaces\Services
 */
interface IntegrationsPool
{
    /**
     * Register integration
     *
     * @param Integration $integration
     *
     * @return IntegrationsPool
     */
    public function registerIntegration(Integration $integration): self;

    /**
     * Get integration list
     *
     * @return array
     */
    public function getIntegrations(): array;
}