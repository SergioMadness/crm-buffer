<?php namespace App\Subsystems\IntegrationHub\Interfaces\Services;

use App\Subsystems\IntegrationHub\Interfaces\EventData;
use App\Subsystems\IntegrationHub\Interfaces\Models\ProcessOptions;
use App\Subsystems\IntegrationHub\Interfaces\Models\SubsystemOptions;

/**
 * Subsystem interface
 * @package App\Subsystems\IntegrationHub\Interfaces\Services
 */
interface Subsystem
{
    /**
     * Set options with values
     *
     * @param ProcessOptions $options
     *
     * @return Subsystem
     */
    public function setProcessOptions(ProcessOptions $options): self;

    /**
     * Get available options
     *
     * @return SubsystemOptions
     */
    public function getAvailableOptions(): SubsystemOptions;

    /**
     * Process event data
     *
     * @param EventData $eventData
     *
     * @return EventData
     */
    public function process(EventData $eventData): EventData;
}