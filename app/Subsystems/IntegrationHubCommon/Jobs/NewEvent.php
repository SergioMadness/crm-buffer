<?php namespace App\Subsystems\IntegrationHubCommon\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Subsystems\IntegrationHubCommon\Models\Request;
use App\Subsystems\IntegrationHubCommon\Events\NewRequest;
use App\Subsystems\IntegrationHubCommon\Interfaces\Repositories\RequestRepository;

class NewEvent implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Request
     */
    public $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function handle(RequestRepository $repository): void
    {
        $repository->save($this->request);

        event(new NewRequest($this->request));
    }
}