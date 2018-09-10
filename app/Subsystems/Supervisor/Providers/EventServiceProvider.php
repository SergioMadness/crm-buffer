<?php namespace App\Subsystems\Supervisor\Providers;

use App\Subsystems\IntegrationHub\Events\NewRequest;
use App\Subsystems\Supervisor\Listeners\NewRequestListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;


class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        NewRequest::class => [
            NewRequestListener::class,
        ],
    ];
}
