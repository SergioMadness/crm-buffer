<?php namespace App\Subsystems\CRMBuffer\Interfaces;

use App\Subsystems\CRMBuffer\Interfaces\Models\Driver;

interface DriverPool
{
    /**
     * Register driver
     *
     * @param Driver $driver
     *
     * @return DriverPool
     */
    public function registerDriver(Driver $driver): self;

    /**
     * Check driver exists
     *
     * @param string $alias
     *
     * @return bool
     */
    public function driverExists(string $alias): bool;

    /**
     * Get list of drivers
     *
     * @return array
     */
    public function getDrivers(): array;

    /**
     * Get driver by alias
     *
     * @param string $alias
     *
     * @return Driver
     */
    public function getDriver(string $alias): ?Driver;
}