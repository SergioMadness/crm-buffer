<?php

namespace App\Providers;

use App\Services\RequestValidation;
use App\Repositories\LeadRepository;
use App\Repositories\UserRepository;
use App\Repositories\ContactRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\RequestRepository;
use App\Drivers\Bitrix24\DriverProvider;
use App\Repositories\ApplicationRepository;
use App\Drivers\PartnerBox\DriverProvider as PAPDriverProvider;
use App\Interfaces\Repositories\LeadRepository as ILeadRepository;
use App\Interfaces\Repositories\UserRepository as IUserRepository;
use App\Interfaces\Services\RequestValidation as IRequestValidation;
use App\Interfaces\Repositories\ContactRepository as IContactRepository;
use App\Interfaces\Repositories\RequestRepository as IRequestRepository;
use App\Interfaces\Repositories\ApplicationRepository as IApplicationRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(IRequestValidation::class, RequestValidation::class);
        $this->app->singleton(IApplicationRepository::class, ApplicationRepository::class);
        $this->app->singleton(IRequestRepository::class, RequestRepository::class);
        $this->app->singleton(ILeadRepository::class, LeadRepository::class);
        $this->app->singleton(IUserRepository::class, function () {
            return new UserRepository(config('app.login'), config('app.password'));
        });
        $this->app->singleton(IContactRepository::class, ContactRepository::class);

        $this->app->register(DriverProvider::class);
        $this->app->register(PAPDriverProvider::class);
    }
}
