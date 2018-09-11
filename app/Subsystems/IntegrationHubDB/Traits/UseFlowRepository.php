<?php namespace App\Subsystems\IntegrationHubDB\Traits;

use App\Subsystems\IntegrationHubDB\Interfaces\Repositories\FlowRepository;

/**
 * Trait for classes that use flow repository
 * @package App\Subsystems\IntegrationHubDB\Traits
 */
trait UseFlowRepository
{
    /**
     * @var FlowRepository
     */
    private $flowRepository;

    /**
     * @return FlowRepository
     */
    public function getFlowRepository(): FlowRepository
    {
        return $this->flowRepository;
    }

    /**
     * @param FlowRepository $flowRepository
     *
     * @return $this
     */
    public function setFlowRepository(FlowRepository $flowRepository): self
    {
        $this->flowRepository = $flowRepository;

        return $this;
    }
}