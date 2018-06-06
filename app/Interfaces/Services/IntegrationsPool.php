<?php namespace App\Interfaces\Services;

use App\Interfaces\Model;

/**
 * Interface for integrations pool
 * @package App\Interfaces\Services
 */
interface IntegrationsPool
{
    /**
     * Event name fired before lead sending
     */
    public const EVENT_BEFORE_SEND_LEAD = 'before:send:lead';

    /**
     * Event name fired before contact sending
     */
    public const EVENT_BEFORE_SEND_CONTACT = 'before:send:contact';

    /**
     * Event name fired when lead was sent
     */
    public const EVENT_AFTER_SEND_LEAD = 'after:send:lead';

    /**
     * Event name fired when contact was sent
     */
    public const EVENT_AFTER_SEND_CONTACT = 'after:send:contact';

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

    /**
     * Add callback
     *
     * @param string   $event
     * @param callable $callback
     * @param string   $driver
     *
     * @return IntegrationsPool
     */
    public function on(string $event, callable $callback, string $driver = '*'): self;

    /**
     * Fire event
     *
     * @param string $event
     * @param Model  $model
     *
     * @return IntegrationsPool
     */
    public function fire(string $event, Model $model): self;
}