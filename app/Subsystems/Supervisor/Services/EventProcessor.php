<?php namespace App\Subsystems\Supervisor\Service;

use App\Subsystems\IntegrationHubDB\Models\Request;
use App\Subsystems\Supervisor\Interfaces\Services\Dispatcher;
use App\Subsystems\Supervisor\Interfaces\Services\Supervisor;
use App\Subsystems\IntegrationHubCommon\Interfaces\Services\RequestProcessor;

/**
 * Class EventProcessor
 * @package App\Subsystems\Supervisor\Service
 */
class EventProcessor implements RequestProcessor
{
    /**
     * @var Dispatcher
     */
    private $dispatcher;

    /**
     * @var Supervisor
     */
    private $supervisor;

    public function __construct(Dispatcher $dispatcher, Supervisor $supervisor)
    {
        $this->setDispatcher($dispatcher)->setSupervisor($supervisor);
    }

    /**
     * Process event
     *
     * @param Request $event
     *
     * @return RequestProcessor
     */
    public function event(Request $event): RequestProcessor
    {
        $this->getDispatcher()->dispatch($event, $this->getSupervisor()->nextProcess($event));

        return $this;
    }

    /**
     * @return Dispatcher
     */
    public function getDispatcher(): Dispatcher
    {
        return $this->dispatcher;
    }

    /**
     * @param Dispatcher $dispatcher
     *
     * @return EventProcessor
     */
    public function setDispatcher(Dispatcher $dispatcher): self
    {
        $this->dispatcher = $dispatcher;

        return $this;
    }

    /**
     * @return Supervisor
     */
    public function getSupervisor(): Supervisor
    {
        return $this->supervisor;
    }

    /**
     * @param Supervisor $supervisor
     *
     * @return EventProcessor
     */
    public function setSupervisor(Supervisor $supervisor): self
    {
        $this->supervisor = $supervisor;

        return $this;
    }
}