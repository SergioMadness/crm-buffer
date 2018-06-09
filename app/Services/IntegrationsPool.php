<?php namespace App\Services;

use App\Repositories\RequestRepository;
use App\Interfaces\Services\IntegrationsPool as IIntegrationsPool;

/**
 * Integration pool
 * @package App\Services
 */
class IntegrationsPool implements IIntegrationsPool
{
    /**
     * Registered drivers
     *
     * @var array
     */
    private $pool = [];

    /**
     * integration list
     *
     * @var array
     */
    private $integrations = [];

    /**
     * Register driver
     *
     * @param string $driver
     * @param array  $settings
     *
     * @return IIntegrationsPool
     */
    public function registerDriver(string $driver, array $settings = []): IIntegrationsPool
    {
        $this->pool[$driver] = $settings;

        return $this;
    }

    /**
     * Remove driver
     *
     * @param string $driver
     *
     * @return IIntegrationsPool
     */
    public function removeDriver(string $driver): IIntegrationsPool
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
     * Register integration
     *
     * @param string $alias
     *
     * @return IIntegrationsPool
     */
    public function registerIntegration(string $alias): IIntegrationsPool
    {
        $this->integrations[] = $alias;
        RequestRepository::registerSystem($alias);

        return $this;
    }

    /**
     * Get integration list
     *
     * @return array
     */
    public function getIntegrations(): array
    {
        return $this->integrations;
    }
}