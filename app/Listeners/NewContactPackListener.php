<?php namespace App\Listeners;

use App\Models\Lead;
use App\Models\Request;
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
        $pool = $this->getIntegrationsPool();
        $integrations = $pool->getIntegrations();

        foreach ($integrations as $alias) {
            /** @var CRMService $crmService */
            $crmService = app($alias);
            foreach ($event->contactsData as $contact) {
                /** @var Lead $contact */
                if ($contact->needIToProcess($alias)) {
                    try {
                        $crmService->sendContact($contact->body);
                        $message = $crmService->getMessages();
                        $status = $crmService->isSuccess() ? Request::STATUS_SUCCESS : Request::STATUS_FAILED;
                    } catch (\Exception $ex) {
                        $message = $ex->getMessage();
                        $status = Request::STATUS_RETRY;
                    }
                    event(new RequestResponse($contact->id, $message, $alias, $status));
                }
            }
        }
    }
}