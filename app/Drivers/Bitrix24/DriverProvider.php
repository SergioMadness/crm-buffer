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
        $url = config('systems.bitrix24.url');
        $clientId = config('systems.bitrix24.client_id');
        $clientSecret = config('systems.bitrix24.client_secret');
        $accessToken = Bitrix24Service::loadAccessToken();
        $refreshToken = Bitrix24Service::loadRefreshToken();
        if (!empty($url) && !empty($clientId) && !empty($clientSecret) && !empty($accessToken) && !empty($refreshToken)) {
            $bitrix24ServiceInstance = new Bitrix24Service(
                $url,
                $clientId,
                $clientSecret,
                $accessToken,
                $refreshToken,
                config('systems.bitrix24.scope')
            );
            $this->app->instance(IBitrix24Service::class, $bitrix24ServiceInstance);
            $this->app->register(EventProvider::class);

            RequestRepository::registerSystem(self::DRIVER_NAME);
        }
    }
}