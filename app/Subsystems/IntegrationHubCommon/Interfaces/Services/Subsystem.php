<?php namespace App\Subsystems\IntegrationHubCommon\Interfaces\Services;

use App\Subsystems\IntegrationHubCommon\Interfaces\EventData;
use App\Subsystems\IntegrationHubCommon\Interfaces\Models\ProcessOptions;
use App\Subsystems\IntegrationHubCommon\Interfaces\Models\SubsystemOptions;

/**
 * Subsystem interface
 * @package App\Subsystems\IntegrationHubCommon\Interfaces\Services
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