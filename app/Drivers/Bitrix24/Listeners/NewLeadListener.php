<?php namespace App\Drivers\Bitrix24\Listeners;

use App\Events\NewLead;
use App\Drivers\Bitrix24\Interfaces\CRMService;
use App\Events\RequestResponse;

/**
 * New lead event handler
 * @package App\Drivers\Bitrix24\Listeners
 */
class NewLeadListener
{
    /**
     * @var CRMService
     */
    private $crmService;

    public function __construct(CRMService $crmService)
    {
        $this->setCrmService($crmService);
    }

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
        } catch (\Exception $ex) {
            $message = $ex->getMessage();
        }
        event(new RequestResponse($event->id, $service->isSuccess(), $message));
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
     * @return NewLeadListener
     */
    public function setCrmService(CRMService $crmService): self
    {
        $this->crmService = $crmService;

        return $this;
    }


}