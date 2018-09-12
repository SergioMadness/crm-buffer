<?php namespace App\Subsystems\IntegrationHubCommon\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Subsystems\IntegrationHubCommon\Interfaces\EventData;
use App\Subsystems\IntegrationHubDB\Interfaces\Models\ProcessOptions;

/**
 * Job with event data for processing through queues
 * @package App\Subsystems\IntegrationHubCommon\Jobs
 */
class NewEvent implements ShouldQueue
{
    use InteractsWithQueue, Queueable;

    /**
     * @var EventData
     */
    public $eventData;

    /**
     * @var ProcessOptions
     */
    public $processOptions;

    public function __construct(EventData $eventData, ProcessOptions $processOptions)
    {
        $this->eventData = $eventData;
        $this->processOptions = $processOptions;
    }

    public function handle()
    {

    }
}