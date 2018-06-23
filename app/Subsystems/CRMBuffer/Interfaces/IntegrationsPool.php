<?php namespace App\Subsystems\CRMBuffer\Interfaces;

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
     * Register integration
     *
     * @param string $alias
     *
     * @return IntegrationsPool
     */
    public function registerIntegration(string $alias): self;

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

    /**
     * Get integration list
     *
     * @return array
     */
    public function getIntegrations(): array;
}