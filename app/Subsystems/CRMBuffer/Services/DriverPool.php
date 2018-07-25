<?php namespace App\Subsystems\CRMBuffer\Services;

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
     * @param string $driver
     * @param array  $settings
     *
     * @return IDriverPool
     */
    public function registerDriver(string $driver, array $settings = []): IDriverPool
    {
        $this->pool[$driver] = $settings;

        return $this;
    }

    /**
     * Remove driver
     *
     * @param string $driver
     *
     * @return IDriverPool
     */
    public function removeDriver(string $driver): IDriverPool
    {
        if (isset($this->pool[$driver]) !== false) {
            unset($this->pool[$driver]);
        }

        return $this;
    }

    /**
     * Check driver exists
     *
     * @param string $driver
     *
     * @return bool
     */
    public function driverExists(string $driver): bool
    {
        return isset($this->pool[$driver]);
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
     * Get driver settings
     *
     * @param string $driver
     *
     * @return array
     */
    public function getSettings(string $driver): array
    {
        return $this->pool[$driver] ?? [];
    }

    /**
     * Add settings
     *
     * @param string $driver
     * @param array  $settings
     *
     * @return IDriverPool
     */
    public function addSettings(string $driver, array $settings): IDriverPool
    {
        if (isset($this->pool[$driver])) {
            $this->pool[$driver] = array_merge($this->pool[$driver], $settings);
        }

        return $this;
    }
}