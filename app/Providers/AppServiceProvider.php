<?php namespace professionalweb\IntegrationHub\Providers;

use Illuminate\Support\ServiceProvider;
use Rollbar\Laravel\RollbarServiceProvider;
use Barryvdh\Debugbar\ServiceProvider as DebugbarServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        if ($this->app->environment() === 'production') {
            $this->app->register(RollbarServiceProvider::class);
        } else {
            $this->app->register(DebugbarServiceProvider::class);
        }
    }
}
