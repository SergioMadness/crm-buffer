<?php namespace App\Subsystems\Supervisor\Service;

use Illuminate\Foundation\Bus\DispatchesJobs;
use App\Subsystems\IntegrationHubCommon\Jobs\NewEvent;
use App\Subsystems\IntegrationHubCommon\Interfaces\EventData;
use App\Subsystems\IntegrationHubCommon\Events\EventToProcess;
use App\Subsystems\IntegrationHubDB\Interfaces\Models\ProcessOptions;
use App\Subsystems\Supervisor\Interfaces\Services\Dispatcher as IDispatcher;

/**
 * Service that send event data to next step.
 * Through event or queue
 * @package App\Subsystems\Supervisor\Service
 */
class Dispatcher implements IDispatcher
{
    use DispatchesJobs {
        dispatch as protected dispatchToQueue;
    }

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
            if (!empty($processOptions->getQueue())) {
                $this->toQueue($event, $processOptions);
            } elseif ($processOptions->getHost()) {
                $this->byAPI($event, $processOptions);
            }
        } else {
            $this->sendEvent($event, $processOptions);
        }

        return $this;
    }

    /**
     * Send event to processor through API
     *
     * @param EventData      $event
     * @param ProcessOptions $processOptions
     */
    protected function byAPI(EventData $event, ProcessOptions $processOptions): void
    {
        // TODO: call api
    }

    /**
     * Add event to queue
     *
     * @param EventData      $event
     * @param ProcessOptions $processOptions
     */
    protected function toQueue(EventData $event, ProcessOptions $processOptions): void
    {
        $this->dispatchToQueue(
            (new NewEvent($event, $processOptions))->onQueue($processOptions->getQueue())
        );
    }

    /**
     * Send event to local processor
     *
     * @param EventData      $event
     * @param ProcessOptions $processOptions
     */
    protected function sendEvent(EventData $event, ProcessOptions $processOptions): void
    {
        event(new EventToProcess($event, $processOptions));
    }
}