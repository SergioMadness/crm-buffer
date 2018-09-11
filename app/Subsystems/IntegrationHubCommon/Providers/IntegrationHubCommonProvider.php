<?php namespace App\Subsystems\IntegrationHubCommon\Providers;

use Illuminate\Support\ServiceProvider;

class IntegrationHubCommonProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->register(ValidationProvider::class);
    }
}