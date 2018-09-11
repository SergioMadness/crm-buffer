<?php namespace App\Subsystems\IntegrationHubDB\Repositories;

use App\Subsystems\IntegrationHubDB\Models\Flow;
use App\Subsystems\IntegrationHubDB\Interfaces\Repositories\FlowRepository as IFlowRepository;

/**
 * Repository to work with event flows
 * @package App\Subsystems\IntegrationHubDB\Repositories
 */
class FlowRepository extends BaseRepository implements IFlowRepository
{

    /**
     * Get default processing flow
     *
     * @return Flow|null
     */
    public function getDefault(): ?Flow
    {
        return Flow::query()->where('is_default', true)->where('is_active', true)->first();
    }
}