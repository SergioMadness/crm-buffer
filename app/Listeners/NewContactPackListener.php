<?php namespace App\Listeners;

use App\Models\Lead;
use App\Models\Request;
use App\Models\Integration;
use App\Events\NewContactPack;
use App\Events\RequestResponse;
use App\Traits\UseIntegrationPool;
use App\Interfaces\Services\CRMService;
use App\Traits\UseIntegrationRepository;
use App\Interfaces\Services\IntegrationsPool;
use App\Interfaces\Repositories\IntegrationRepository;

/**
 * New contact event handler
 * @package App\Listeners
 */
class NewContactPackListener
{
    use UseIntegrationRepository, UseIntegrationPool;

    public function __construct(IntegrationRepository $integrationRepository, IntegrationsPool $integrationsPool)
    {
        $this->setIntegrationRepository($integrationRepository)
            ->setIntegrationsPool($integrationsPool);
    }

    /**
     * handle event
     *
     * @param NewContactPack $event
     */
    public function handle(NewContactPack $event): void
    {
        $drivers = $this->getIntegrationsPool()->getDrivers();

        foreach ($drivers as $alias => $settings) {
            $this->getIntegrationRepository()->get([
                'driver' => $alias,
            ])->each(function (Integration $integration) use ($event, $alias, $settings) {
                /** @var CRMService $crmService */
                $crmService = app($alias);
                $crmService->setSettings($integration->settings);
                $system = $alias . '_' . $integration->id;
                foreach ($event->contactsData as $contact) {
                    /** @var Lead $contact */
                    if ($contact->needIToProcess($system)) {
                        try {
                            $crmService->sendContact($contact->body);
                            $message = $crmService->getMessages();
                            $status = $crmService->isSuccess() ? Request::STATUS_SUCCESS : Request::STATUS_FAILED;
                        } catch (\Exception $ex) {
                            $message = $ex->getMessage();
                            $status = Request::STATUS_RETRY;
                        }
                        event(new RequestResponse($contact->id, $message, $system, $status));
                    }
                }
            });
        }
    }
}