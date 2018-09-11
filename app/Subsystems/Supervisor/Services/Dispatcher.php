<?php namespace App\Subsystems\Supervisor\Service;

use App\Subsystems\IntegrationHubCommon\Jobs\NewEvent;
use Illuminate\Foundation\Bus\DispatchesJobs;
use App\Subsystems\IntegrationHubCommon\Interfaces\EventData;
use App\Subsystems\IntegrationHubDB\Interfaces\Models\ProcessOptions;
use App\Subsystems\Supervisor\Interfaces\Services\Dispatcher as IDispatcher;

/**
 * Service that send event data to next step.
 * Through event or queue
 * @package App\Subsystems\Supervisor\Service
 */
class Dispatcher implements IDispatcher
{
    use DispatchesJobs;

    /**
     * Dispatch event
     *
     * @param EventData      $event
     * @param ProcessOptions $processOptions
     *
     * @return IDispatcher
     */
    public function dispatch(EventData $event, ProcessOptions $processOptions): IDispatcher
    {
        if ($processOptions->isRemote()) {

        }
    }
}