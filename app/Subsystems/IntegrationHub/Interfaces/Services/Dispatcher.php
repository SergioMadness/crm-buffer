<?php namespace App\Subsystems\IntegrationHub\Interfaces\Services;

use App\Subsystems\IntegrationHub\Interfaces\EventData;
use App\Subsystems\IntegrationHub\Interfaces\Models\ProcessOptions;

/**
 * Interface for process dispatcher
 * @package App\Subsystems\IntegrationHub\Interfaces\Services
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