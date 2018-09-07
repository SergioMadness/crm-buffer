<?php namespace App\Subsystems\IntegrationHub\Interfaces\Services;

use App\Subsystems\IntegrationHub\Interfaces\EventData;

/**
 * Interface for event supervisor
 * @package App\Subsystems\IntegrationHub\Interfaces\Services
 */
interface Supervisor
{
    /**
     * Add/update event
     *
     * @param EventData $eventData
     *
     * @return Supervisor
     */
    public function event(EventData $eventData): self;
}