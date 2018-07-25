<?php

namespace App\Providers;

use App\Services\Navigator;
use App\Repositories\UserRepository;
use App\Interfaces\Services\Navigation;
use Illuminate\Support\ServiceProvider;
use App\Drivers\Bitrix24\DriverProvider;
use App\Repositories\ApplicationRepository;
use App\Subsystems\CRMBuffer\SubsystemProvider;
use App\Drivers\PartnerBox\DriverProvider as PAPDriverProvider;
use App\Interfaces\Repositories\UserRepository as IUserRepository;
use App\Interfaces\Repositories\ApplicationRepository as IApplicationRepository;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        /** @var Navigation $navigationService */
        $navigationService = app(Navigation::class);
        $navigationService->register('Settings', 'Приложения', '/index.html');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(IApplicationRepository::class, ApplicationRepository::class);
        $this->app->singleton(IUserRepository::class, function () {
            return new UserRepository(config('app.login'), config('app.password'));
        });

        $this->app->singleton(Navigation::class, Navigator::class);

        $this->app->register(SubsystemProvider::class);
        $this->app->register(DriverProvider::class);
        $this->app->register(PAPDriverProvider::class);
        $this->app->register(\App\Drivers\Bitrix24LeadDistribution\DriverProvider::class);
    }
}
