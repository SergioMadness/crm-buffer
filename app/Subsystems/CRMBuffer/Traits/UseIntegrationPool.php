<?php namespace App\Subsystems\CRMBuffer\Traits;

use App\Subsystems\CRMBuffer\Interfaces\IntegrationsPool;

/**
 * Trait for that what uses integration pool
 * @package App\Traits
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