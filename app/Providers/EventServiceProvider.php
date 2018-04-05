<?php

namespace App\Providers;

use App\Events\RequestResponse;
use App\Listeners\RequestResponseListener;
use Laravel\Lumen\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        RequestResponse::class => [
            RequestResponseListener::class,
        ],
    ];
}
