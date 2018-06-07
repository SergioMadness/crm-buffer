<?php namespace App\Repositories;

use App\Interfaces\Model;
use App\Interfaces\Services\IntegrationsPool;
use App\Models\Integration;
use App\Interfaces\Repositories\IntegrationRepository as IIntegrationRepository;

/**
 * Repository of integrations
 * @package App\Repositories
 */
class IntegrationRepository extends BaseRepository implements IIntegrationRepository
{
    protected static $availableSystems = [];

    /**
     * @var IntegrationsPool
     */
    protected $integrationPool;

    public function __construct(IntegrationsPool $integrationsPool)
    {
        $this
            ->setIntegrationPool($integrationsPool)
            ->setModelClass(Integration::class);
    }

    public function fill(Model $model, array $attributes = []): Model
    {
        $driver = $attributes['driver'] ?? $model->driver;
        if (!empty($driver) && isset($attributes['settings']) && $this->getIntegrationPool()->driverExists($driver)) {
            $diverSettings = $this->getIntegrationPool()->getDrivers()[$driver];
            foreach ($attributes['settings'] as $key => $val) {
                if (isset($diverSettings[$key])) {
                    switch ($diverSettings[$key]['type']) {
                        case 'bool':
                            $attributes['settings'][$key] = ($val === 'true' || $val === 'on' || $val == 1);
                            break;
                    }
                }
            }
        }

        return parent::fill($model, $attributes);
    }

    /**
     * Get integration pool
     *
     * @return IntegrationsPool
     */
    public function getIntegrationPool(): IntegrationsPool
    {
        return $this->integrationPool;
    }

    /**
     * Set integration pool
     *
     * @param IntegrationsPool $integrationPool
     *
     * @return $this
     */
    public function setIntegrationPool(IntegrationsPool $integrationPool): self
    {
        $this->integrationPool = $integrationPool;

        return $this;
    }
}