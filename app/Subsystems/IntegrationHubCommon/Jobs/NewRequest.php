<?php namespace App\Subsystems\IntegrationHubCommon\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Subsystems\IntegrationHubDB\Models\Request;
use App\Subsystems\IntegrationHubCommon\Interfaces\EventData;
use App\Subsystems\IntegrationHubCommon\Events\NewRequest as NewRequestEvent;

class NewRequest implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var EventData
     */
    public $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function handle(): void
    {
        event(new NewRequestEvent($this->request));
    }
}