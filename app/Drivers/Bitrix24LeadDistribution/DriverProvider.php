<?php namespace App\Drivers\Bitrix24LeadDistribution;

use App\Interfaces\EventData;
use Illuminate\Support\ServiceProvider;
use App\Drivers\Bitrix24\Services\Bitrix24Service;
use App\Drivers\Bitrix24LeadDistribution\Interfaces\Filter;
use App\Drivers\Bitrix24LeadDistribution\Algorithms\RoundRobin;
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
                if (!empty($duplicateUserId = $service->getUserOnDuplicate())) {
                    $data['ASSIGNED_BY_ID'] = $duplicateUserId;
                }
            } else {
                $body['ASSIGNED_BY_ID'] = app(IDistributionService::class)->getUserId(
                    config('systems.bitrix24.filter', []),
                    $body
                );
                if (!empty($body['ASSIGNED_BY_ID'])) {
                    $body['STATUS_ID'] = $service->getDistributedStatus();
                }
            }
            $data->setData($body);
        });
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