<?php namespace App\Subsystems\IntegrationHubCommon\Interfaces\Services;

use App\Subsystems\IntegrationHubCommon\Interfaces\EventData;
use App\Subsystems\IntegrationHubCommon\Interfaces\Models\ProcessOptions;

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