<?php namespace professionalweb\IntegrationHub\Subsystems\CRMBuffer\Traits;

use professionalweb\IntegrationHub\Subsystems\CRMBuffer\Interfaces\Models\Driver;
use professionalweb\IntegrationHub\Subsystems\CRMBuffer\Interfaces\Models\Plugin;

/**
 * Trait for drivers has plugins
 * @package professionalweb\IntegrationHub\Subsystems\CRMBuffer\Traits
 */
trait HasPlugins
{
    protected $plugins = [];

    /**
     * Attach plugin to driver
     *
     * @param Plugin $plugin
     *
     * @return Driver
     */
    public function attachPlugin(Plugin $plugin): Driver
    {
        $this->plugins[] = $plugin->boot($this);

        return $this;
    }

    /**
     * Get plugin list
     *
     * @return array
     */
    public function getPlugins(): array
    {
        return $this->plugins;
    }
}