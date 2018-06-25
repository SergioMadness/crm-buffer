<?php namespace App\Subsystems\CRMBuffer;

use App\Traits\Subsystem;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Console\Scheduling\Schedule;
use App\Subsystems\CRMBuffer\Commands\SendPack;

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

        $this->publishes([
            __DIR__ . '/migrations' => database_path('migrations'),
            __DIR__ . '/frontend'   => base_path('public/crm-buffer'),
        ]);

        app(Kernel::class)->addCommand(SendPack::class);
        app(Schedule::class)->command(SendPack::class)->cron('*/' . config('systems.period') . ' * * * *');
    }
}