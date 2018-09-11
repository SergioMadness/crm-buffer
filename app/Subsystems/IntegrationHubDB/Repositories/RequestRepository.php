<?php namespace App\Subsystems\IntegrationHubDB\Repositories;

use App\Subsystems\IntegrationHubDB\Models\Request;
use App\Subsystems\IntegrationHubDB\Interfaces\Model;
use App\Subsystems\IntegrationHubDB\Interfaces\Repositories\RequestRepository as IRequestRepository;

/**
 * Repository of requests
 * @package App\Subsystems\Supervisor\Repositories
 */
class RequestRepository extends BaseRepository implements IRequestRepository
{
    public function __construct()
    {
        $this->setModelClass(Request::class);
    }

    /**
     * Create model; Set default type
     *
     * @param array $attributes
     *
     * @return Model
     */
    public function create(array $attributes = []): Model
    {
        if (!isset($attributes['request_type'])) {
            $attributes['request_type'] = Request::DEFAULT_TYPE;
        }

        return parent::create($attributes);
    }
}