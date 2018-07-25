<?php namespace App\Drivers\Bitrix24;

use Illuminate\Support\ServiceProvider;
use App\Drivers\Bitrix24\Services\Bitrix24Service;
use App\Subsystems\CRMBuffer\Interfaces\DriverPool;
use App\Drivers\Bitrix24\Interfaces\Bitrix24Service as IBitrix24Service;

class DriverProvider extends ServiceProvider
{
    public const DRIVER_NAME = 'bitrix';

    public function boot(): void
    {
        /** @var DriverPool $integrationPool */
        app(DriverPool::class)->registerDriver(self::DRIVER_NAME, [
            'url'                => [
                'name' => 'Домен',
                'type' => 'string',
            ],
            'hook'               => [
                'name' => 'Hook',
                'type' => 'string',
            ],
            'client_id'          => [
                'name' => 'Client id',
                'type' => 'string',
            ],
            'client_secret'      => [
                'name' => 'Client secret',
                'type' => 'string',
            ],
            'access_token'       => [
                'name' => 'Access token',
                'type' => 'string',
            ],
            'refresh_token'      => [
                'name' => 'Refresh token',
                'type' => 'string',
            ],
            'check_duplicates'   => [
                'name' => 'Помечать дубликаты',
                'type' => 'bool',
            ],
            'duplicate_status'   => [
                'name' => 'ID статуса дубликата',
                'type' => 'string',
            ],
        ]);
    }

    public function register(): void
    {
        $this->app->bind(IBitrix24Service::class, Bitrix24Service::class);
        $this->app->bind(self::DRIVER_NAME, Bitrix24Service::class);
    }
}