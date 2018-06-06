<?php namespace App\Repositories;

use App\Models\Integration;
use App\Interfaces\Repositories\IntegrationRepository as IIntegrationRepository;

/**
 * Repository of integrations
 * @package App\Repositories
 */
class IntegrationRepository extends BaseRepository implements IIntegrationRepository
{
    protected static $availableSystems = [];

    public function __construct()
    {
        $this->setModelClass(Integration::class);
    }
}