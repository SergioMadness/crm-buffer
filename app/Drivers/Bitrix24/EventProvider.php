<?php namespace App\Drivers\Bitrix24;

use App\Events\NewLead;
use App\Events\NewLeadPack;
use Laravel\Lumen\Providers\EventServiceProvider;
use App\Drivers\Bitrix24\Listeners\NewLeadListener;
use App\Drivers\Bitrix24\Listeners\NewLeadPackListener;

class EventProvider extends EventServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        NewLead::class     => [
            NewLeadListener::class,
        ],
        NewLeadPack::class => [
            NewLeadPackListener::class,
        ],
    ];
}