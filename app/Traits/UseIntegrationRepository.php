<?php namespace App\Traits;

use App\Interfaces\Repositories\IntegrationRepository;

/**
 * Trait for that what uses integration repository
 * @package App\Traits
 */
trait UseIntegrationRepository
{
    /**
     * @var IntegrationRepository
     */
    private $repository;

    /**
     * Set integrations repository
     *
     * @param IntegrationRepository $repository
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
     * @return IntegrationRepository
     */
    public function getIntegrationRepository(): IntegrationRepository
    {
        return $this->repository;
    }
}