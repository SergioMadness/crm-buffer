<?php namespace App\Subsystems\CRMBuffer\Traits;

use App\Subsystems\CRMBuffer\Interfaces\Repositories\IntegrationRepository;

/**
 * Trait for that what uses integration repository
 * @package App\Traits
 */
trait UseIntegrationRepository
{
    /**
     * @var \App\Subsystems\CRMBuffer\Interfaces\Repositories\IntegrationRepository
     */
    private $repository;

    /**
     * Set integrations repository
     *
     * @param \App\Subsystems\CRMBuffer\Interfaces\Repositories\IntegrationRepository $repository
     *
     * @return self
     */
    public function setIntegrationRepository(IntegrationRepository $repository): self
    {
        $this->repository = $repository;

        return $this;
    }

    /**
     * Get integrations repository
     *
     * @return \App\Subsystems\CRMBuffer\Interfaces\Repositories\IntegrationRepository
     */
    public function getIntegrationRepository(): IntegrationRepository
    {
        return $this->repository;
    }
}