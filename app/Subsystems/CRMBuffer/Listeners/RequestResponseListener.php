<?php

namespace App\Subsystems\CRMBuffer\Listeners;

use App\Subsystems\CRMBuffer\Events\RequestResponse;
use App\Subsystems\CRMBuffer\Traits\UseRequestRepository;
use App\Subsystems\CRMBuffer\Interfaces\Repositories\RequestRepository;

class RequestResponseListener
{
    use UseRequestRepository;

    public function __construct(RequestRepository $repository)
    {
        $this->setRequestRepository($repository);
    }

    /**
     * Handle the event.
     *
     * @param  RequestResponse $event
     *
     * @return void
     */
    public function handle(RequestResponse $event): void
    {
        $this->getRequestRepository()->setStatus(
            $event->id,
            $event->status,
            $event->response,
            $event->system
        );
    }
}
