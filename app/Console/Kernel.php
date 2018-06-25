<?php

namespace App\Console;

use App\Console\Commands\PublishVendor;
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
        PublishVendor::class,
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

    }

    /**
     * Add command
     *
     * @param string $class
     *
     * @return Kernel
     */
    public function addCommand(string $class): self
    {
        $this->commands[] = $class;

        return $this;
    }
}
