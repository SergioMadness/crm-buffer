<?php namespace App\Subsystems\CRMBuffer\Interfaces;

interface DriverPool
{
    /**
     * Register driver
     *
     * @param string $driver
     *
     * @param array  $settings
     *
     * @return DriverPool
     */
    public function registerDriver(string $driver, array $settings = []): self;

    /**
     * Remove driver
     *
     * @param string $driver
     *
     * @return DriverPool
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
     * Get driver settings
     *
     * @param string $driver
     *
     * @return array
     */
    public function getSettings(string $driver): array;

    /**
     * Add settings
     *
     * @param string $driver
     * @param array  $settings
     *
     * @return DriverPool
     */
    public function addSettings(string $driver, array $settings): self;
}