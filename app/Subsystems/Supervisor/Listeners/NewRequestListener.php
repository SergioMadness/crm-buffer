<?php namespace App\Subsystems\Supervisor\Listeners;

use App\Subsystems\IntegrationHubCommon\Events\NewRequest;
use App\Subsystems\IntegrationHubCommon\Interfaces\Services\RequestProcessor;

class NewRequestListener
{
    public function handler(NewRequest $event, RequestProcessor $requestProcessor): void
    {
        $requestProcessor->event($event->request);
    }
}