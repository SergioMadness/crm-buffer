<?php namespace App\Drivers\Bitrix24\Listeners;

use App\Models\Request;
use App\Events\NewContact;
use App\Events\RequestResponse;
use App\Drivers\Bitrix24\DriverProvider;
use App\Drivers\Bitrix24\Interfaces\Bitrix24Service;

/**
 * New contact event handler
 * @package App\Drivers\Bitrix24\Listeners
 */
class NewContactListener
{

    /**
     * @var Bitrix24Service
     */
    private $crmService;

    public function __construct(Bitrix24Service $crmService)
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
     * @return Bitrix24Service
     */
    public function getCrmService(): Bitrix24Service
    {
        return $this->crmService;
    }

    /**
     * Set CRM service
     *
     * @param Bitrix24Service $crmService
     *
     * @return NewContactListener
     */
    public function setCrmService(Bitrix24Service $crmService): self
    {
        $this->crmService = $crmService;

        return $this;
    }


}