<?php namespace professionalweb\IntegrationHub\Subsystems\CRMBuffer\Interfaces\Models;

use Illuminate\Contracts\Support\Arrayable;

/**
 * Interface for driver
 * @package professionalweb\IntegrationHub\Subsystems\CRMBuffer\Interfaces\Models
 */
interface Driver extends Arrayable
{
    /**
     * Get driver name
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Get driver alias
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
     * Get fields available in service
     *
     * @return array
     */
    public function getAvailableFields(): array;

    /**
     * Attach plugin to driver
     *
     * @param Plugin $plugin
     *
     * @return Driver
     */
    public function attachPlugin(Plugin $plugin): self;

    /**
     * Get plugin list
     *
     * @return array
     */
    public function getPlugins(): array;
}