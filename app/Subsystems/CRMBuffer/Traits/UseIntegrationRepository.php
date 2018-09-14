<?php namespace professionalweb\IntegrationHub\Subsystems\CRMBuffer\Traits;

use professionalweb\IntegrationHub\Subsystems\CRMBuffer\Interfaces\Repositories\IntegrationRepository;

/**
 * Trait for that what uses integration repository
 * @package professionalweb\IntegrationHub\Traits
 */
trait UseIntegrationRepository
{
    /**
     * @var \professionalweb\IntegrationHub\Subsystems\CRMBuffer\Interfaces\Repositories\IntegrationRepository
     */
    private $repository;

    /**
     * Set integrations repository
     *
     * @param \professionalweb\IntegrationHub\Subsystems\CRMBuffer\Interfaces\Repositories\IntegrationRepository $repository
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
     * @return \professionalweb\IntegrationHub\Subsystems\CRMBuffer\Interfaces\Repositories\IntegrationRepository
     */
    public function getIntegrationRepository(): IntegrationRepository
    {
        return $this->repository;
    }
}