<?php namespace App\Subsystems\IntegrationHubCommon\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Subsystems\IntegrationHubCommon\Interfaces\EventData;

/**
 * Job with event data for processing through queues
 * @package App\Subsystems\IntegrationHubCommon\Jobs
 */
class NewEvent implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var EventData
     */
    public $eventData;

    public function __construct(EventData $eventData)
    {
        $this->eventData = $eventData;
    }

    public function handle()
    {

    }
}