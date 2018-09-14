<?php namespace professionalweb\IntegrationHub\Drivers\PartnerBox;

use Illuminate\Support\ServiceProvider;
use professionalweb\IntegrationHub\Drivers\PartnerBox\Models\PartnerBoxDriver;
use professionalweb\IntegrationHub\Subsystems\CRMBuffer\Interfaces\DriverPool;
use professionalweb\IntegrationHub\Drivers\PartnerBox\Services\PartnerBoxService;
use professionalweb\IntegrationHub\Drivers\PartnerBox\Services\PartnerBoxIntegrationService;
use professionalweb\IntegrationHub\Drivers\PartnerBox\Interfaces\PartnerBoxService as IPartnerBoxService;
use professionalweb\IntegrationHub\Drivers\PartnerBox\Interfaces\PartnerBoxIntegrationService as IPartnerBoxIntegrationService;

class DriverProvider extends ServiceProvider
{
    public const DRIVER_NAME = 'partnerbox';

    public function boot(): void
    {
        app(DriverPool::class)->registerDriver(new PartnerBoxDriver());
    }

    public function register(): void
    {
        $this->app->bind(IPartnerBoxIntegrationService::class, PartnerBoxIntegrationService::class);
        $this->app->bind(IPartnerBoxService::class, PartnerBoxService::class);
        $this->app->bind(self::DRIVER_NAME, PartnerBoxService::class);
    }
}