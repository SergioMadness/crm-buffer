<?php namespace App\Drivers\Bitrix24\Listeners;

use App\Models\Lead;
use App\Events\NewLeadPack;
use App\Events\RequestResponse;
use App\Drivers\Bitrix24\DriverProvider;
use App\Drivers\Bitrix24\Interfaces\CRMService;

/**
 * New lead event handler
 * @package App\Drivers\Bitrix24\Listeners
 */
class NewLeadPackListener
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
                    $success = $service->isSuccess();
                } catch (\Exception $ex) {
                    $message = $ex->getMessage();
                    $success = false;
                }
                event(new RequestResponse($lead->id, $message, DriverProvider::DRIVER_NAME, $success));
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