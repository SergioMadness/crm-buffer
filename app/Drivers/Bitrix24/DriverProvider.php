<?php namespace App\Drivers\Bitrix24;

use App\Repositories\RequestRepository;
use Illuminate\Support\ServiceProvider;
use App\Drivers\Bitrix24\Services\Bitrix24Service;
use App\Drivers\Bitrix24\Interfaces\Bitrix24Service as IBitrix24Service;

class DriverProvider extends ServiceProvider
{
    public const DRIVER_NAME = 'bitrix';

    public function register()
    {
        $bitrix24ServiceInstance = new Bitrix24Service(
            config('systems.bitrix24.url'),
            config('systems.bitrix24.client_id'),
            config('systems.bitrix24.client_secret'),
            Bitrix24Service::loadAccessToken(),
            Bitrix24Service::loadRefreshToken(),
            config('systems.bitrix24.scope')
        );
        $this->app->instance(IBitrix24Service::class, $bitrix24ServiceInstance);
        $this->app->register(EventProvider::class);

        RequestRepository::registerSystem(self::DRIVER_NAME);
    }
}