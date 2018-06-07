<?php namespace App\Drivers\Bitrix24LeadDistribution;

use App\Models\Lead;
use App\Interfaces\Model;
use Illuminate\Support\ServiceProvider;
use App\Interfaces\Services\IntegrationsPool;
use App\Drivers\Bitrix24LeadDistribution\Interfaces\Filter;
use App\Drivers\Bitrix24LeadDistribution\Algorithms\RoundRobin;
use App\Drivers\Bitrix24LeadDistribution\Services\UserFilterService;
use App\Drivers\Bitrix24LeadDistribution\Services\DistributionService;
use App\Drivers\Bitrix24LeadDistribution\Interfaces\DistributionService as IDistributionService;

class DriverProvider extends ServiceProvider
{
    public function boot(): void
    {
        app(IntegrationsPool::class)->on(IntegrationsPool::EVENT_BEFORE_SEND_LEAD, function (Model $lead) {
            /** @var Lead $lead */
            $body = $lead->body;
            $body['ASSIGNED_BY_ID'] = app(IDistributionService::class)->getUserId(
                config('systems.bitrix24.filter', []),
                $body
            );
            $lead->body = $body;
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