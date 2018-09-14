<?php namespace professionalweb\IntegrationHub\Drivers\Bitrix24;

use Illuminate\Support\ServiceProvider;
use professionalweb\IntegrationHub\Drivers\Bitrix24\Models\Bitrix24Driver;
use professionalweb\IntegrationHub\Drivers\Bitrix24\Services\Bitrix24Service;
use professionalweb\IntegrationHub\Subsystems\CRMBuffer\Interfaces\DriverPool;
use professionalweb\IntegrationHub\Drivers\Bitrix24\Interfaces\Bitrix24Service as IBitrix24Service;

class DriverProvider extends ServiceProvider
{
    public const DRIVER_NAME = 'bitrix';

    public function boot(): void
    {
        /** @var DriverPool $integrationPool */
        app(DriverPool::class)->registerDriver(new Bitrix24Driver());
    }

    public function register(): void
    {
        $this->app->bind(IBitrix24Service::class, Bitrix24Service::class);
        $this->app->bind(self::DRIVER_NAME, Bitrix24Service::class);
    }
}