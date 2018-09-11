<?php namespace App\Subsystems\IntegrationHubDB\Traits;

use App\Subsystems\IntegrationHubDB\Interfaces\Repositories\ProcessOptionsRepository;

/**
 * Trait for classes that use process options repository
 * @package App\Subsystems\IntegrationHubDB\Traits
 */
trait UseProcessOptionsRepository
{
    /**
     * @var ProcessOptionsRepository
     */
    private $processOptionsRepository;

    /**
     * @return ProcessOptionsRepository
     */
    public function getProcessOptionsRepository(): ProcessOptionsRepository
    {
        return $this->processOptionsRepository;
    }

    /**
     * @param ProcessOptionsRepository $processOptionsRepository
     *
     * @return $this
     */
    public function setProcessOptionsRepository(ProcessOptionsRepository $processOptionsRepository): self
    {
        $this->processOptionsRepository = $processOptionsRepository;

        return $this;
    }
}