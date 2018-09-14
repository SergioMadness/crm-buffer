<?php namespace professionalweb\IntegrationHub\Subsystems\CRMBuffer\Abstractions;

use professionalweb\IntegrationHub\Subsystems\CRMBuffer\Interfaces\Models\Plugin as IPlugin;

/**
 * Base class for plugin
 * @package professionalweb\IntegrationHub\Subsystems\CRMBuffer\Abstractions
 */
abstract class Plugin implements IPlugin
{

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'name'               => $this->getName(),
            'alias'              => $this->getAlias(),
            'settings'           => $this->getSettings(),
            'frontend_component' => $this->getFrontendComponent(),
        ];
    }
}