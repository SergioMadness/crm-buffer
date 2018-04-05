<?php namespace App\Traits;

use App\Interfaces\Repositories\ApplicationRepository;

/**
 * Trait for what uses application repository
 * @package App\Traits
 */
trait UseApplicationRepository
{
    /**
     * @var ApplicationRepository
     */
    private $applicationRepository;

    /**
     * Set application repository
     *
     * @param ApplicationRepository $applicationRepository
     *
     * @return self
     */
    public function setApplicationRepository(ApplicationRepository $applicationRepository): self
    {
        $this->applicationRepository = $applicationRepository;

        return $this;
    }

    /**
     * Get application repository
     *
     * @return ApplicationRepository
     */
    public function getApplicationRepository(): ApplicationRepository
    {
        return $this->applicationRepository;
    }
}