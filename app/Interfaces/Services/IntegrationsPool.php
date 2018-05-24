<?php namespace App\Interfaces\Services;

/**
 * Interface for integrations pool
 * @package App\Interfaces\Services
 */
interface IntegrationsPool
{
    /**
     * Register driver
     *
     * @param string $driver
     *
     * @param array  $settings
     *
     * @return IntegrationsPool
     */
    public function registerDriver(string $driver, array $settings = []): self;

    /**
     * Remove driver
     *
     * @param string $driver
     *
     * @return IntegrationsPool
     */
    public function removeDriver(string $driver): self;

    /**
     * Check driver exists
     *
     * @param string $driver
     *
     * @return bool
     */
    public function driverExists(string $driver): bool;

    /**
     * Get list of drivers
     *
     * @return array
     */
    public function getDrivers(): array;
}