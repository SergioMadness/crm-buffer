<?php namespace App\Interfaces\Services;

use App\Interfaces\EventData;
use App\Interfaces\Models\ProcessOptions;
use App\Interfaces\Models\SubsystemOptions;

/**
 * Subsystem interface
 * @package App\Interfaces\Services
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
    public function setOptions(ProcessOptions $options): self;

    /**
     * Get available options
     *
     * @return SubsystemOptions
     */
    public function getOptions(): SubsystemOptions;

    /**
     * Process event data
     *
     * @param EventData $eventData
     *
     * @return EventData
     */
    public function process(EventData $eventData): EventData;
}