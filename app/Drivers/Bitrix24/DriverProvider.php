<?php namespace App\Drivers\Bitrix24;

use Illuminate\Support\ServiceProvider;
use App\Drivers\Bitrix24\Models\Bitrix24Driver;
use App\Drivers\Bitrix24\Services\Bitrix24Service;
use App\Subsystems\CRMBuffer\Interfaces\DriverPool;
use App\Drivers\Bitrix24\Interfaces\Bitrix24Service as IBitrix24Service;

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