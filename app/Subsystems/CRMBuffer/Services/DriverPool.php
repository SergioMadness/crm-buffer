<?php namespace App\Subsystems\CRMBuffer\Services;

use App\Subsystems\CRMBuffer\Interfaces\Models\Driver;
use App\Subsystems\CRMBuffer\Interfaces\DriverPool as IDriverPool;

class DriverPool implements IDriverPool
{
    /**
     * Registered drivers
     *
     * @var array
     */
    private $pool = [];

    /**
     * Register driver
     *
     * @param Driver $driver
     *
     * @return IDriverPool
     */
    public function registerDriver(Driver $driver): IDriverPool
    {
        $this->pool[] = $driver;

        return $this;
    }

    /**
     * Check driver exists
     *
     * @param string $alias
     *
     * @return bool
     */
    public function driverExists(string $alias): bool
    {
        return $this->getDriver($alias) !== null;
    }

    /**
     * Get list of drivers
     *
     * @return array
     */
    public function getDrivers(): array
    {
        return $this->pool;
    }

    /**
     * Get driver by alias
     *
     * @param string $alias
     *
     * @return Driver
     */
    public function getDriver(string $alias): ?Driver
    {
        foreach ($this->getDrivers() as $driver) {
            /** @var Driver $driver */
            if ($driver->getAlias() === $alias) {
                return $driver;
            }
        }

        return null;
    }
}