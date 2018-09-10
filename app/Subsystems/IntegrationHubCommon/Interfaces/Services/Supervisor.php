<?php namespace App\Subsystems\IntegrationHubCommon\Interfaces\Services;

use App\Subsystems\IntegrationHubCommon\Interfaces\EventData;

/**
 * Interface for event supervisor
 * @package App\Subsystems\IntegrationHubCommon\Interfaces\Services
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