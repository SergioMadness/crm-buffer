<?php namespace App\Subsystems\IntegrationHubCommon\Events;

use App\Subsystems\IntegrationHubCommon\Interfaces\EventData;
use App\Subsystems\IntegrationHubDB\Interfaces\Models\ProcessOptions;

class EventToProcess
{
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
}