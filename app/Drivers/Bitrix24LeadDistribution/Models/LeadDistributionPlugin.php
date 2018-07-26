<?php namespace App\Drivers\Bitrix24LeadDistribution\Models;

use App\Interfaces\EventData;
use App\Subsystems\CRMBuffer\Abstractions\Plugin;
use App\Drivers\Bitrix24\Services\Bitrix24Service;
use App\Subsystems\CRMBuffer\Interfaces\Models\Driver;
use App\Subsystems\CRMBuffer\Interfaces\Models\Plugin as IPlugin;
use App\Drivers\Bitrix24LeadDistribution\Interfaces\DistributionService;

/**
 * plugin for lead distribution
 * @package App\Drivers\Bitrix24LeadDistribution
 */
class LeadDistributionPlugin extends Plugin
{

    /**
     * Get plugin name
     *
     * @return string
     */
    public function getName(): string
    {
        return 'Распределение лидов';
    }

    /**
     * Get plugin alias
     *
     * @return string
     */
    public function getAlias(): string
    {
        return 'lead_distribution';
    }

    /**
     * Get available settings
     *
     * @return array
     */
    public function getSettings(): array
    {
        return [
            'distributed_status' => [
                'name' => 'ID статуса "распределен"',
                'type' => 'string',
            ],
            'user_on_duplicate'  => [
                'name' => 'ID пользователя для дубликатов',
                'type' => 'string',
            ],
        ];
    }

    /**
     * Actions on attach to driver
     *
     * @param Driver $driver
     *
     * @return Plugin
     */
    public function boot(Driver $driver): IPlugin
    {
        Bitrix24Service::on(Bitrix24Service::EVENT_BEFORE_SEND_LEAD, function (EventData $data, Bitrix24Service $service) {
            $body = $data->getData();

            if (isset($body['STATUS_ID']) && $body['STATUS_ID'] === $service->getDuplicateStatus()) {
                if (!empty($duplicateUserId = $service->getSettings('user_on_duplicate'))) {
                    $data['ASSIGNED_BY_ID'] = $duplicateUserId;
                }
            } else {
                $body['ASSIGNED_BY_ID'] = app(DistributionService::class)->getUserId(
                    config('systems.bitrix24.filter', []),
                    $body
                );
                if (!empty($body['ASSIGNED_BY_ID'])) {
                    $body['STATUS_ID'] = $service->getSettings('distributed_status');
                }
            }
            $data->setData($body);
        });

        return $this;
    }

    /**
     * Get frontend component name
     *
     * @return string
     */
    public function getFrontendComponent(): string
    {
        return 'lead-distribution';
    }
}