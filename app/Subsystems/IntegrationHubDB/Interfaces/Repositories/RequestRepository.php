<?php namespace App\Subsystems\IntegrationHubDB\Interfaces\Repositories;

use App\Subsystems\IntegrationHubDB\Interfaces\Model;
use App\Subsystems\IntegrationHubDB\Interfaces\Repository;

/**
 * Interface for repository of requests
 * @package App\Subsystems\IntegrationHubDB\Interfaces\Repositories
 *
 * @method create(array $attributes = []): Request
 * @method fill(Model $model, array $attributes = []): Request
 * @method model($id): ?Request
 */
interface RequestRepository extends Repository
{

}