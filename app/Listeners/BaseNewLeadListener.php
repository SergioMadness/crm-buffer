<?php namespace App\Listeners;

use App\Models\Request;
use App\Events\NewLead;
use App\Events\RequestResponse;
use App\Interfaces\Services\CRMService;

/**
 * New lead event handler
 * @package App\Listeners
 */
abstract class BaseNewLeadListener
{
    /**
     * @var CRMService
     */
    private $crmService;

    abstract protected function getDriverName(): string;

    /**
     * handle event
     *
     * @param NewLead $event
     */
    public function handle(NewLead $event): void
    {
        $service = $this->getCrmService();
        try {
            $service->sendLead($event->data);
            $message = $service->getMessages();
            $status = $service->isSuccess() ? Request::STATUS_SUCCESS : Request::STATUS_FAILED;
        } catch (\Exception $ex) {
            $message = $ex->getMessage();
            $status = Request::STATUS_RETRY;
        }
        event(new RequestResponse($event->id, $message, $this->getDriverName(), $status));
    }

    /**
     * Get CRM service
     *
     * @return CRMService
     */
    public function getCrmService(): CRMService
    {
        return $this->crmService;
    }

    /**
     * Set CRM service
     *
     * @param CRMService $crmService
     *
     * @return BaseNewLeadListener
     */
    public function setCrmService(CRMService $crmService): self
    {
        $this->crmService = $crmService;

        return $this;
    }


}