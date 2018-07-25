<?php namespace App\Subsystems\CRMBuffer\Services;

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
     * @param string $alias
     *
     * @return IIntegrationsPool
     */
    public function registerIntegration(string $alias): IIntegrationsPool
    {
        $this->integrations[] = $alias;
        RequestRepository::registerSystem($alias);

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