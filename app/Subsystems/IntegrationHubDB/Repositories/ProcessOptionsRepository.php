<?php namespace App\Subsystems\IntegrationHubDB\Repositories;

use App\Subsystems\IntegrationHubDB\Models\ProcessOptions;
use App\Subsystems\IntegrationHubDB\Interfaces\Repositories\ProcessOptionsRepository as IProcessOptionsRepository;

/**
 * Process options repository
 * @package App\Subsystems\IntegrationHubDB\Repositories
 */
class ProcessOptionsRepository extends BaseRepository implements IProcessOptionsRepository
{
    public function __construct()
    {
        $this->setModelClass(ProcessOptions::class);
    }
}