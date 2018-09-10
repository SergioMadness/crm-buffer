<?php namespace App\Subsystems\IntegrationHubCommon\Providers;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use App\Subsystems\IntegrationHubCommon\Repositories\RequestRepository;
use App\Subsystems\IntegrationHubCommon\Interfaces\Repositories\RequestRepository as IRequestRepository;

class IntegrationHubCommonProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(IRequestRepository::class, RequestRepository::class);

        $this->app->register(ValidationProvider::class);
    }

    public function boot(Router $router): void
    {

    }
}