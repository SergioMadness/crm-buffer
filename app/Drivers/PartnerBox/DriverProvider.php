<?php namespace App\Drivers\PartnerBox;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\Services\IntegrationsPool;
use App\Drivers\PartnerBox\Services\PartnerBoxService;
use App\Drivers\PartnerBox\Services\PartnerBoxIntegrationService;
use App\Drivers\PartnerBox\Interfaces\PartnerBoxService as IPartnerBoxService;
use App\Drivers\PartnerBox\Interfaces\PartnerBoxIntegrationService as IPartnerBoxIntegrationService;

class DriverProvider extends ServiceProvider
{
    public const DRIVER_NAME = 'partnerbox';

    public function boot(): void
    {
        app(IntegrationsPool::class)->registerDriver(self::DRIVER_NAME, [
            'server_url'               => [
                'name' => 'Url сервиса',
                'type' => 'string',
            ],
            'sale_url'                 => [
                'name' => 'Sales url',
                'type' => 'string',
            ],
            'login'                    => [
                'name' => 'Логин',
                'type' => 'string',
            ],
            'password'                 => [
                'name' => 'Пароль',
                'type' => 'password',
            ],
            'account_id'               => [
                'name' => 'Account id',
                'type' => 'string',
            ],
            'lead_event_name'          => [
                'name' => 'Lead event name',
                'type' => 'string',
            ],
            'lead_event_product_id'    => [
                'name' => 'Lead event product id',
                'type' => 'string',
            ],
            'contact_event_name'       => [
                'name' => 'Contact event name',
                'type' => 'string',
            ],
            'contact_event_product_id' => [
                'name' => 'Contact event product id',
                'type' => 'string',
            ],
        ]);
    }

    public function register(): void
    {
        $this->app->bind(IPartnerBoxIntegrationService::class, PartnerBoxIntegrationService::class);
        $this->app->bind(IPartnerBoxService::class, PartnerBoxService::class);
        $this->app->bind(self::DRIVER_NAME, PartnerBoxService::class);
    }
}