<?php

namespace App\Providers;

use App\Events\NewLeadPack;
use App\Events\NewContactPack;
use App\Events\RequestResponse;
use App\Listeners\NewLeadPackListener;
use App\Listeners\NewContactPackListener;
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
        NewLeadPack::class     => [
            NewLeadPackListener::class,
        ],
        NewContactPack::class  => [
            NewContactPackListener::class,
        ],
    ];
}
