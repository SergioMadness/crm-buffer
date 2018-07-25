<?php namespace App\Subsystems\CRMBuffer;

use App\Traits\Subsystem;
use App\Services\RequestValidation;
//use App\Interfaces\Services\CRMService;
use App\Interfaces\Services\Navigation;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Console\Scheduling\Schedule;
use App\Subsystems\CRMBuffer\Commands\SendPack;
use App\Subsystems\CRMBuffer\Models\Integration;
use App\Subsystems\CRMBuffer\Services\DriverPool;
use App\Subsystems\CRMBuffer\Services\IntegrationsPool;
use App\Subsystems\CRMBuffer\Repositories\LeadRepository;
use App\Subsystems\CRMBuffer\Repositories\ContactRepository;
use App\Subsystems\CRMBuffer\Repositories\RequestRepository;
use App\Subsystems\CRMBuffer\Repositories\IntegrationRepository;
use App\Subsystems\CRMBuffer\Interfaces\DriverPool as IDriverPool;
use App\Interfaces\Services\RequestValidation as IRequestValidation;
use App\Subsystems\CRMBuffer\Interfaces\IntegrationsPool as IIntegrationsPool;
use App\Subsystems\CRMBuffer\Interfaces\Repositories\LeadRepository as ILeadRepository;
use App\Subsystems\CRMBuffer\Interfaces\Repositories\ContactRepository as IContactRepository;
use App\Subsystems\CRMBuffer\Interfaces\Repositories\RequestRepository as IRequestRepository;
use App\Subsystems\CRMBuffer\Interfaces\Repositories\IntegrationRepository as IIntegrationRepository;

class SubsystemProvider extends ServiceProvider
{
    use Subsystem;

    public function register(): void
    {
        $this->app->register(EventServiceProvider::class);

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

        $this->loadMigrationsFrom(__DIR__ . '/migrations');

        /** @var Navigation $navigationService */
        $navigationService = app(Navigation::class);
        $navigationService->register('Integration hub', 'Лиды', '/crm-buffer/leads.html');
        $navigationService->register('Integration hub', 'Контакты', '/crm-buffer/contacts.html');
        $navigationService->register('Integration hub', 'Интеграции', '/crm-buffer/integrations.html');

        app(Kernel::class)->addCommand(SendPack::class);
        app(Schedule::class)->command(SendPack::class)->cron('*/' . config('systems.period') . ' * * * *');

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