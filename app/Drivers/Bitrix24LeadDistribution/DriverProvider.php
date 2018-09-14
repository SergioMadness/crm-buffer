<?php namespace professionalweb\IntegrationHub\Drivers\Bitrix24LeadDistribution;

use Illuminate\Support\ServiceProvider;
use professionalweb\IntegrationHub\Subsystems\CRMBuffer\Interfaces\DriverPool;
use professionalweb\IntegrationHub\Drivers\Bitrix24LeadDistribution\Interfaces\Filter;
use professionalweb\IntegrationHub\Drivers\Bitrix24LeadDistribution\Algorithms\RoundRobin;
use professionalweb\IntegrationHub\Drivers\Bitrix24\DriverProvider as Bitrix24DriverProvider;
use professionalweb\IntegrationHub\Drivers\Bitrix24LeadDistribution\Services\UserFilterService;
use professionalweb\IntegrationHub\Drivers\Bitrix24LeadDistribution\Services\DistributionService;
use professionalweb\IntegrationHub\Drivers\Bitrix24LeadDistribution\Models\LeadDistributionPlugin;
use professionalweb\IntegrationHub\Drivers\Bitrix24LeadDistribution\Interfaces\DistributionService as IDistributionService;

class DriverProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/frontend' => base_path('public/lead-distribution'),
        ]);

        /** @var DriverPool $driverPool */
        $driverPool = app(DriverPool::class);
        if ($driverPool->driverExists(Bitrix24DriverProvider::DRIVER_NAME)) {
            $driverPool
                ->getDriver(Bitrix24DriverProvider::DRIVER_NAME)
                ->attachPlugin(new LeadDistributionPlugin());
        }
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