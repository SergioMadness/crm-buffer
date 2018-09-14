<?php namespace professionalweb\IntegrationHub\Subsystems\CRMBuffer\Repositories;

use professionalweb\IntegrationHub\Interfaces\Model;
use professionalweb\IntegrationHub\Repositories\BaseRepository;
use professionalweb\IntegrationHub\Subsystems\CRMBuffer\Models\Integration;
use professionalweb\IntegrationHub\Subsystems\CRMBuffer\Interfaces\DriverPool;
use professionalweb\IntegrationHub\Subsystems\CRMBuffer\Interfaces\Repositories\IntegrationRepository as IIntegrationRepository;

/**
 * Repository of integrations
 * @package professionalweb\IntegrationHub\Repositories
 */
class IntegrationRepository extends BaseRepository implements IIntegrationRepository
{
    protected static $availableSystems = [];

    /**
     * @var DriverPool
     */
    protected $driverPool;

    public function __construct(DriverPool $driverPool)
    {
        $this
            ->setDriverPool($driverPool)
            ->setModelClass(Integration::class);
    }

    public function fill(Model $model, array $attributes = []): Model
    {
        $driver = $attributes['driver'] ?? $model->driver;
        if (!empty($driver) && isset($attributes['settings']) && $this->getDriverPool()->driverExists($driver)) {
            $diverSettings = $this->getDriverPool()->getDriver($driver)->getSettings();
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
     * Get driver pool
     *
     * @return DriverPool
     */
    public function getDriverPool(): DriverPool
    {
        return $this->driverPool;
    }

    /**
     * Set driver pool
     *
     * @param DriverPool $driverPool
     *
     * @return $this
     */
    public function setDriverPool(DriverPool $driverPool): self
    {
        $this->driverPool = $driverPool;

        return $this;
    }
}