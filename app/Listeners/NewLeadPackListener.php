<?php namespace App\Listeners;

use App\Models\Lead;
use App\Models\Request;
use App\Events\NewLeadPack;
use App\Models\Integration;
use App\Events\RequestResponse;
use App\Traits\UseIntegrationPool;
use App\Interfaces\Services\CRMService;
use App\Traits\UseIntegrationRepository;
use App\Interfaces\Services\IntegrationsPool;
use App\Interfaces\Repositories\IntegrationRepository;

/**
 * New lead event handler
 * @package App\Listeners
 */
class NewLeadPackListener
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
     * @param NewLeadPack $event
     */
    public function handle(NewLeadPack $event): void
    {
        $pool = $this->getIntegrationsPool();
        $drivers = $pool->getDrivers();

        foreach ($drivers as $alias => $settings) {
            $this->getIntegrationRepository()->get([
                'driver' => $alias,
            ])->each(function (Integration $integration) use ($event, $alias, $settings, $pool) {
                /** @var CRMService $crmService */
                $crmService = app($alias);
                $crmService->setSettings($integration->settings);
                $system = $alias . '_' . $integration->id;
                foreach ($event->leadsData as $lead) {
                    /** @var Lead $lead */
                    if ($lead->needIToProcess($system)) {
                        try {
                            $pool->fire(IntegrationsPool::EVENT_BEFORE_SEND_LEAD, $lead);
                            $crmService->sendLead($lead->body);
                            $pool->fire(IntegrationsPool::EVENT_AFTER_SEND_LEAD, $lead);
                            $message = $crmService->getMessages();
                            $status = $crmService->isSuccess() ? Request::STATUS_SUCCESS : Request::STATUS_FAILED;
                        } catch (\Exception $ex) {
                            $message = $ex->getMessage();
                            $status = Request::STATUS_RETRY;
                        }
                        event(new RequestResponse($lead->id, $message, $system, $status));
                    }
                }
            });
        }
    }
}