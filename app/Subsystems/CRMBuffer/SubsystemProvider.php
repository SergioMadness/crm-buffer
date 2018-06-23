<?php namespace App\Subsystems\CRMBuffer;

use App\Traits\Subsystem;
use Illuminate\Support\ServiceProvider;

class SubsystemProvider extends ServiceProvider
{
    use Subsystem;

    public function register(): void
    {
        $this->app->register(EventServiceProvider::class);
    }

    public function boot(): void
    {
        $this->loadRoutes(__DIR__ . '/routes.php');
        $this->addMigrations(__DIR__ . '/migrations');
        $this->publish('crm-buffer', __DIR__ . '/frontend');
    }
}