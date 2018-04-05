<?php

namespace App\Listeners;

use App\Events\RequestResponse;
use App\Models\Request;
use App\Traits\UseRequestRepository;
use App\Interfaces\Repositories\RequestRepository;

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
    public function handle(RequestResponse $event)
    {
        $this->getRequestRepository()->setStatus(
            $event->id,
            $event->success ? Request::STATUS_SUCCESS : Request::STATUS_FAILED,
            json_encode($event->response),
            $event->system
        );
    }
}
