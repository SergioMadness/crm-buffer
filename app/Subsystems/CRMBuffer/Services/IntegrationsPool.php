<?php namespace App\Subsystems\CRMBuffer\Services;

use App\Subsystems\CRMBuffer\Interfaces\Models\Integration;
use App\Subsystems\CRMBuffer\Repositories\RequestRepository;
use App\Subsystems\CRMBuffer\Interfaces\IntegrationsPool as IIntegrationsPool;

/**
 * Integration pool
 * @package App\Services
 */
class IntegrationsPool implements IIntegrationsPool
{

    /**
     * integration list
     *
     * @var array
     */
    private $integrations = [];

    /**
     * Register integration
     *
     * @param Integration $integration
     *
     * @return IIntegrationsPool
     */
    public function registerIntegration(Integration $integration): IIntegrationsPool
    {
        $this->integrations[] = $integration;
        RequestRepository::registerSystem($integration->getAlias());

        return $this;
    }

    /**
     * Get integration list
     *
     * @return array
     */
    public function getIntegrations(): array
    {
        return $this->integrations;
    }
}