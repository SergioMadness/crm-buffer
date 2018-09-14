<?php namespace professionalweb\IntegrationHub\Subsystems\CRMBuffer\Traits;

use professionalweb\IntegrationHub\Subsystems\CRMBuffer\Interfaces\IntegrationsPool;

/**
 * Trait for that what uses integration pool
 * @package professionalweb\IntegrationHub\Traits
 */
trait UseIntegrationPool
{
    /**
     * @var IntegrationsPool
     */
    private $pool;

    /**
     * Set integrations pool
     *
     * @param IntegrationsPool $pool
     *
     * @return self
     */
    public function setIntegrationsPool(IntegrationsPool $pool): self
    {
        $this->pool = $pool;

        return $this;
    }

    /**
     * Get integrations pool
     *
     * @return IntegrationsPool
     */
    public function getIntegrationsPool(): IntegrationsPool
    {
        return $this->pool;
    }
}