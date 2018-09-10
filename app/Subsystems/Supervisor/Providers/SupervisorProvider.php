<?php namespace App\Subsystems\Supervisor\Providers;

use Illuminate\Support\ServiceProvider;

class SupervisorProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->register(EventServiceProvider::class);
    }

    public function boot(): void
    {

    }
}