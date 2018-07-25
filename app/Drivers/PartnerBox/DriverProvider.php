<?php namespace App\Drivers\PartnerBox;

use Illuminate\Support\ServiceProvider;
use App\Drivers\PartnerBox\Models\PartnerBoxDriver;
use App\Subsystems\CRMBuffer\Interfaces\DriverPool;
use App\Drivers\PartnerBox\Services\PartnerBoxService;
use App\Drivers\PartnerBox\Services\PartnerBoxIntegrationService;
use App\Drivers\PartnerBox\Interfaces\PartnerBoxService as IPartnerBoxService;
use App\Drivers\PartnerBox\Interfaces\PartnerBoxIntegrationService as IPartnerBoxIntegrationService;

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