<?php

namespace App\Subsystems\CRMBuffer;

use App\Subsystems\CRMBuffer\Events\NewLeadPack;
use App\Subsystems\CRMBuffer\Events\NewContactPack;
use App\Subsystems\CRMBuffer\Events\RequestResponse;
use App\Subsystems\CRMBuffer\Listeners\NewLeadPackListener;
use App\Subsystems\CRMBuffer\Listeners\NewContactPackListener;
use App\Subsystems\CRMBuffer\Listeners\RequestResponseListener;
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
