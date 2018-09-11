<?php namespace App\Subsystems\IntegrationHubDB\Interfaces\Repositories;

use App\Subsystems\IntegrationHubDB\Models\Flow;
use App\Subsystems\IntegrationHubDB\Interfaces\Model;
use App\Subsystems\IntegrationHubDB\Interfaces\Repository;

/**
 * Flow repository interface
 * @package App\Subsystems\IntegrationHubDB\Interfaces\Repositories
 *
 * @method create(array $attributes = []): Flow
 * @method fill(Model $model, array $attributes = []): Flow
 * @method model($id): ?Flow
 */
interface FlowRepository extends Repository
{
    /**
     * Get default processing flow
     *
     * @return Flow|null
     */
    public function getDefault(): ?Flow;
}