<?php namespace professionalweb\IntegrationHub\Subsystems\CRMBuffer\Interfaces\Models;

use Illuminate\Contracts\Support\Arrayable;

/**
 * Interface for driver plugin
 * @package professionalweb\IntegrationHub\Subsystems\CRMBuffer\Interfaces\Models
 */
interface Plugin extends Arrayable
{
    /**
     * Get plugin name
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Get plugin alias
     *
     * @return string
     */
    public function getAlias(): string;

    /**
     * Get available settings
     *
     * @return array
     */
    public function getSettings(): array;

    /**
     * Actions on attach to driver
     *
     * @param Driver $driver
     *
     * @return Plugin
     */
    public function boot(Driver $driver): self;

    /**
     * Get frontend component name
     *
     * @return string
     */
    public function getFrontendComponent(): string;
}