<?php namespace App\Subsystems\IntegrationHubDB\Interfaces\Repositories;

use App\Subsystems\IntegrationHubDB\Interfaces\Model;
use App\Subsystems\IntegrationHubDB\Interfaces\Repository;

/**
 * Interface for repository with process options
 * @package App\Subsystems\IntegrationHubDB\Interfaces\Repositories
 *
 * @method create(array $attributes = []): ProcessOptions
 * @method fill(Model $model, array $attributes = []): ProcessOptions
 * @method model($id): ?ProcessOptions
 */
interface ProcessOptionsRepository extends Repository
{

}