<?php namespace professionalweb\IntegrationHub\Subsystems\CRMBuffer;

use professionalweb\IntegrationHub\Traits\Subsystem;
use professionalweb\IntegrationHub\Services\RequestValidation;
use professionalweb\IntegrationHub\Interfaces\Services\Navigation;
use Illuminate\Support\ServiceProvider;
use professionalweb\IntegrationHub\Subsystems\CRMBuffer\Models\Integration;
use professionalweb\IntegrationHub\Subsystems\CRMBuffer\Services\DriverPool;
use professionalweb\IntegrationHub\Subsystems\CRMBuffer\Services\IntegrationsPool;
use professionalweb\IntegrationHub\Subsystems\CRMBuffer\Repositories\LeadRepository;
use professionalweb\IntegrationHub\Subsystems\CRMBuffer\Repositories\ContactRepository;
use professionalweb\IntegrationHub\Subsystems\CRMBuffer\Repositories\RequestRepository;
use professionalweb\IntegrationHub\Subsystems\CRMBuffer\Repositories\IntegrationRepository;
use professionalweb\IntegrationHub\Subsystems\CRMBuffer\Interfaces\DriverPool as IDriverPool;
use professionalweb\IntegrationHub\Interfaces\Services\RequestValidation as IRequestValidation;
use professionalweb\IntegrationHub\Subsystems\CRMBuffer\Interfaces\IntegrationsPool as IIntegrationsPool;
use professionalweb\IntegrationHub\Subsystems\CRMBuffer\Interfaces\Repositories\LeadRepository as ILeadRepository;
use professionalweb\IntegrationHub\Subsystems\CRMBuffer\Interfaces\Repositories\ContactRepository as IContactRepository;
use professionalweb\IntegrationHub\Subsystems\CRMBuffer\Interfaces\Repositories\RequestRepository as IRequestRepository;
use professionalweb\IntegrationHub\Subsystems\CRMBuffer\Interfaces\Repositories\IntegrationRepository as IIntegrationRepository;

class SubsystemProvider extends ServiceProvider
{
    use Subsystem;

    public function register(): void
    {
        $this->app->singleton(IRequestValidation::class, RequestValidation::class);
        $this->app->singleton(IRequestRepository::class, RequestRepository::class);
        $this->app->singleton(ILeadRepository::class, LeadRepository::class);
        $this->app->singleton(IContactRepository::class, ContactRepository::class);
        $this->app->singleton(IIntegrationRepository::class, IntegrationRepository::class);
        $this->app->singleton(IIntegrationsPool::class, IntegrationsPool::class);
        $this->app->singleton(IDriverPool::class, DriverPool::class);
    }

    public function boot(): void
    {
        $this->loadRoutes(__DIR__ . '/routes.php');

        $this->publishes([
            __DIR__ . '/migrations' => database_path('migrations'),
            __DIR__ . '/frontend'   => base_path('public/crm-buffer'),
        ]);

        /** @var Navigation $navigationService */
        $navigationService = app(Navigation::class);
        $navigationService->register('Integration hub', 'Лиды', '/crm-buffer/leads.html');
        $navigationService->register('Integration hub', 'Контакты', '/crm-buffer/contacts.html');
        $navigationService->register('Integration hub', 'Интеграции', '/crm-buffer/integrations.html');

        if (!$this->app->runningInConsole()) {
            /** @var IIntegrationsPool $integrationPool */
            $integrationPool = app(IIntegrationsPool::class);
            /** @var IIntegrationRepository $requestRepository */
            $requestRepository = app(IIntegrationRepository::class);
            $requestRepository->get(['is_active' => true])->each(function (Integration $item) use ($integrationPool) {
                $integrationPool->registerIntegration($item);
            });
        }
    }
}