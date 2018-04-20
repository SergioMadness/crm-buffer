<?php namespace App\Listeners;

use App\Interfaces\Services\CRMService;
use App\Models\Lead;
use App\Models\Request;
use App\Events\NewLeadPack;
use App\Events\RequestResponse;
use App\Drivers\PartnerBox\DriverProvider;
use App\Drivers\PartnerBox\Interfaces\CRMService;

/**
 * New lead event handler
 * @package App\Listeners
 */
class BaseNewLeadPackListener
{
    /**
     * @var CRMService
     */
    private $crmService;

    /**
     * handle event
     *
     * @param NewLeadPack $event
     */
    public function handle(NewLeadPack $event): void
    {
        $service = $this->getCrmService();
        foreach ($event->leadsData as $lead) {
            /** @var Lead $lead */
            if ($lead->needIToProcess(DriverProvider::DRIVER_NAME)) {
                try {
                    $service->sendLead($lead->body);
                    $message = $service->getMessages();
                    $status = $service->isSuccess() ? Request::STATUS_SUCCESS : Request::STATUS_FAILED;
                } catch (\Exception $ex) {
                    $message = $ex->getMessage();
                    $status = Request::STATUS_RETRY;
                }
                event(new RequestResponse($lead->id, $message, DriverProvider::DRIVER_NAME, $status));
            }
        }
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
     * @return $this
     */
    public function setCrmService(CRMService $crmService): self
    {
        $this->crmService = $crmService;

        return $this;
    }


}