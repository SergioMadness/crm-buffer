<?php namespace professionalweb\IntegrationHub\Subsystems\CRMBuffer\Abstractions;

use professionalweb\IntegrationHub\Subsystems\CRMBuffer\Interfaces\Models\Driver as IDriver;

/**
 * Base class for driver
 * @package professionalweb\IntegrationHub\Subsystems\CRMBuffer\Abstractions
 */
abstract class Driver implements IDriver
{

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'name'     => $this->getName(),
            'alias'    => $this->getAlias(),
            'settings' => $this->getSettings(),
            'fields'   => $this->getAvailableFields(),
            'plugins'  => $this->getPlugins(),
        ];
    }
}