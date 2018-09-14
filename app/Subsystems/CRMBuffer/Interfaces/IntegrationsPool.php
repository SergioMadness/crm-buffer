<?php namespace professionalweb\IntegrationHub\Subsystems\CRMBuffer\Interfaces;

use professionalweb\IntegrationHub\Subsystems\CRMBuffer\Interfaces\Models\Integration;


/**
 * Interface for integrations pool
 * @package professionalweb\IntegrationHub\Interfaces\Services
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