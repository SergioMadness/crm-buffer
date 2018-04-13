<?php namespace App\Drivers\PartnerBox;

use App\Repositories\RequestRepository;
use Illuminate\Support\ServiceProvider;
use App\Drivers\PartnerBox\Services\PartnerBoxService;
use App\Drivers\PartnerBox\Interfaces\PartnerBoxService as IPartnerBoxService;

class DriverProvider extends ServiceProvider
{
    public const DRIVER_NAME = 'partnerbox';

    public function register()
    {
        $this->app->register(EventProvider::class);

        $this->app->singleton(IPartnerBoxService::class, PartnerBoxService::class);

        RequestRepository::registerSystem(self::DRIVER_NAME);
    }
}