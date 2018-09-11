<?php namespace App\Subsystems\Supervisor\Interfaces\Services;

use App\Subsystems\IntegrationHubCommon\Interfaces\EventData;
use App\Subsystems\IntegrationHubDB\Interfaces\Models\ProcessOptions;

/**
 * Interface for process dispatcher
 * @package App\Subsystems\IntegrationHubCommon\Interfaces\Services
 */
interface Dispatcher
{
    /**
     * Dispatch event
     *
     * @param EventData      $event
     * @param ProcessOptions $processOptions
     *
     * @return Dispatcher
     */
    public function dispatch(EventData $event, ProcessOptions $processOptions): self;
}