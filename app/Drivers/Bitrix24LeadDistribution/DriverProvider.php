<?php namespace App\Drivers\Bitrix24LeadDistribution;

use App\Interfaces\EventData;
use Illuminate\Support\ServiceProvider;
use App\Drivers\Bitrix24\Services\Bitrix24Service;
use App\Subsystems\CRMBuffer\Interfaces\DriverPool;
use App\Drivers\Bitrix24LeadDistribution\Interfaces\Filter;
use App\Drivers\Bitrix24LeadDistribution\Algorithms\RoundRobin;
use App\Drivers\Bitrix24\DriverProvider as Bitrix24DriverProvider;
use App\Drivers\Bitrix24LeadDistribution\Services\UserFilterService;
use App\Drivers\Bitrix24LeadDistribution\Services\DistributionService;
use App\Drivers\Bitrix24LeadDistribution\Interfaces\DistributionService as IDistributionService;

class DriverProvider extends ServiceProvider
{
    public function boot(): void
    {
        Bitrix24Service::on(Bitrix24Service::EVENT_BEFORE_SEND_LEAD, function (EventData $data, Bitrix24Service $service) {
            $body = $data->getData();

            if (isset($body['STATUS_ID']) && $body['STATUS_ID'] === $service->getDuplicateStatus()) {
                if (!empty($duplicateUserId = $service->getSettings('user_on_duplicate'))) {
                    $data['ASSIGNED_BY_ID'] = $duplicateUserId;
                }
            } else {
                $body['ASSIGNED_BY_ID'] = app(IDistributionService::class)->getUserId(
                    config('systems.bitrix24.filter', []),
                    $body
                );
                if (!empty($body['ASSIGNED_BY_ID'])) {
                    $body['STATUS_ID'] = $service->getSettings('distributed_status');
                }
            }
            $data->setData($body);
        });

        /** @var DriverPool $driverPool */
        $driverPool = app(DriverPool::class);
        $driverPool->addSettings(Bitrix24DriverProvider::DRIVER_NAME, [
            'distributed_status' => [
                'name' => 'ID статуса "распределен"',
                'type' => 'string',
            ],
            'user_on_duplicate'  => [
                'name' => 'ID пользователя для дубликатов',
                'type' => 'string',
            ],
        ]);
    }

    public function register(): void
    {
        $this->app->singleton(IDistributionService::class, function () {
            return (new DistributionService())
                ->setFilter(app(Filter::class))
                ->setAlgorithm(new RoundRobin());
        });
        $this->app->singleton(Filter::class, UserFilterService::class);
    }
}