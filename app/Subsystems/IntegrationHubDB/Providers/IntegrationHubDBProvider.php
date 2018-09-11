<?php namespace App\Subsystems\IntegrationHubDB\Providers;

use Illuminate\Support\ServiceProvider;
use App\Subsystems\IntegrationHubDB\Repositories\RequestRepository;
use App\Subsystems\IntegrationHubDB\Interfaces\Repositories\RequestRepository as IRequestRepository;

class IntegrationHubDBProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(IRequestRepository::class, RequestRepository::class);
    }
}