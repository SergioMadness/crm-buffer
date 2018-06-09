<?php namespace App\Services;

use App\Interfaces\Model;
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
     * Event callbacks
     *
     * @var array
     */
    private $callbacks = [];

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
        RequestRepository::registerSystem($driver);

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
     * Add callback
     *
     * @param string   $event
     * @param callable $callback
     * @param string   $driver
     *
     * @return IIntegrationsPool
     */
    public function on(string $event, callable $callback, string $driver = '*'): IIntegrationsPool
    {
        if (empty($driver)) {
            $driver = '*';
        }
        if (!isset($this->callbacks[$event])) {
            $this->callbacks[$event] = [];
        }
        if (!isset($this->callbacks[$event][$driver])) {
            $this->callbacks[$event][$driver] = [];
        }
        $this->callbacks[$event][$driver][] = $callback;

        return $this;
    }

    /**
     * Fire event
     *
     * @param string $event
     * @param Model  $model
     * @param array  $settings
     *
     * @return IIntegrationsPool
     */
    public function fire(string $event, Model $model, array $settings): IIntegrationsPool
    {
        if (isset($this->callbacks[$event])) {
            foreach ($this->callbacks[$event] as $driver => $callbacks) {
                foreach ($callbacks as $callback) {
                    $callback($model, $settings);
                }
            }
        }

        return $this;
    }
}