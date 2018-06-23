<?php

namespace App\Console;

use App\Console\Commands\SendPack;
use App\Console\Commands\PublishFrontend;
use App\Console\Commands\PublishMigrations;
use Illuminate\Console\Scheduling\Schedule;
use Laravel\Lumen\Console\Kernel as ConsoleKernel;


class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        SendPack::class,
        PublishFrontend::class,
        PublishMigrations::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     *
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command(SendPack::class)->cron('*/' . config('systems.period') . ' * * * *');
    }
}
