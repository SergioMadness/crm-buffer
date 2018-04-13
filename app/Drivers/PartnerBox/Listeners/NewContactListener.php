<?php namespace App\Drivers\PartnerBox\Listeners;

use App\Models\Request;
use App\Events\NewContact;
use App\Events\RequestResponse;
use App\Drivers\PartnerBox\DriverProvider;
use App\Drivers\PartnerBox\Interfaces\PartnerBoxService;

/**
 * New contact event handler
 * @package App\Drivers\PartnerBox\Listeners
 */
class NewContactListener
{

    /**
     * @var PartnerBoxService
     */
    private $crmService;

    public function __construct(PartnerBoxService $crmService)
    {
        $this->setCrmService($crmService);
    }

    /**
     * handle event
     *
     * @param NewContact $event
     */
    public function handle(NewContact $event): void
    {
        $service = $this->getCrmService();
        try {
            $service->sendContact($event->data);
            $message = $service->getMessages();
            $status = $service->isSuccess() ? Request::STATUS_SUCCESS : Request::STATUS_FAILED;
        } catch (\Exception $ex) {
            $message = $ex->getMessage();
            $status = Request::STATUS_RETRY;
        }
        event(new RequestResponse($event->id, $message, DriverProvider::DRIVER_NAME, $status));
    }

    /**
     * Get CRM service
     *
     * @return PartnerBoxService
     */
    public function getCrmService(): PartnerBoxService
    {
        return $this->crmService;
    }

    /**
     * Set CRM service
     *
     * @param PartnerBoxService $crmService
     *
     * @return NewContactListener
     */
    public function setCrmService(PartnerBoxService $crmService): self
    {
        $this->crmService = $crmService;

        return $this;
    }


}