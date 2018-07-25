<?php namespace App\Subsystems\CRMBuffer\Listeners;

use App\Interfaces\Services\CRMService;
use App\Subsystems\CRMBuffer\Models\Lead;
use App\Subsystems\CRMBuffer\Models\Request;
use App\Subsystems\CRMBuffer\Events\NewContactPack;
use App\Subsystems\CRMBuffer\Events\RequestResponse;
use App\Subsystems\CRMBuffer\Traits\UseIntegrationPool;
use App\Subsystems\CRMBuffer\Interfaces\IntegrationsPool;
use App\Subsystems\CRMBuffer\Traits\UseIntegrationRepository;
use App\Subsystems\CRMBuffer\Interfaces\Repositories\IntegrationRepository;

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