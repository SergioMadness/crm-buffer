<?php

namespace App\Providers;

use App\Models\Integration;
use App\Services\IntegrationsPool;
use App\Services\RequestValidation;
use App\Repositories\LeadRepository;
use App\Repositories\UserRepository;
use App\Interfaces\Services\CRMService;
use App\Repositories\ContactRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\RequestRepository;
use App\Drivers\Bitrix24\DriverProvider;
use App\Repositories\IntegrationRepository;
use App\Repositories\ApplicationRepository;
use App\Drivers\PartnerBox\DriverProvider as PAPDriverProvider;
use App\Interfaces\Services\IntegrationsPool as IIntegrationsPool;
use App\Interfaces\Repositories\LeadRepository as ILeadRepository;
use App\Interfaces\Repositories\UserRepository as IUserRepository;
use App\Interfaces\Services\RequestValidation as IRequestValidation;
use App\Interfaces\Repositories\ContactRepository as IContactRepository;
use App\Interfaces\Repositories\RequestRepository as IRequestRepository;
use App\Interfaces\Repositories\IntegrationRepository as IIntegrationRepository;
use App\Interfaces\Repositories\ApplicationRepository as IApplicationRepository;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        /** @var IIntegrationsPool $integrationPool */
        $integrationPool = app(IIntegrationsPool::class);
        /** @var IIntegrationRepository $requestRepository */
        $requestRepository = app(IIntegrationRepository::class);
        $requestRepository->get(['is_active' => true])->each(function (Integration $item) use ($integrationPool) {
            $alias = $item->driver . '_' . $item->id;
            $integrationPool->registerIntegration($alias);
            /** @var CRMService $driver */
            $driver = app($item->driver);
            $driver->setSettings($item->settings);
            $this->app->instance($alias, $driver);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(IRequestValidation::class, RequestValidation::class);
        $this->app->singleton(IApplicationRepository::class, ApplicationRepository::class);
        $this->app->singleton(IRequestRepository::class, RequestRepository::class);
        $this->app->singleton(ILeadRepository::class, LeadRepository::class);
        $this->app->singleton(IUserRepository::class, function () {
            return new UserRepository(config('app.login'), config('app.password'));
        });
        $this->app->singleton(IContactRepository::class, ContactRepository::class);
        $this->app->singleton(IIntegrationRepository::class, IntegrationRepository::class);
        $this->app->singleton(IIntegrationsPool::class, IntegrationsPool::class);

        $this->app->register(DriverProvider::class);
        $this->app->register(PAPDriverProvider::class);

        $this->app->register(\App\Drivers\Bitrix24LeadDistribution\DriverProvider::class);
    }
}
