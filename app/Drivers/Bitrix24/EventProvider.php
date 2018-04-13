<?php namespace App\Drivers\Bitrix24;

use App\Events\NewLeadPack;
use App\Events\NewContactPack;
use Laravel\Lumen\Providers\EventServiceProvider;
use App\Drivers\Bitrix24\Listeners\NewLeadPackListener;
use App\Drivers\Bitrix24\Listeners\NewContactPackListener;

class EventProvider extends EventServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
//        NewLead::class        => [
//            NewLeadListener::class,
//        ],
        NewLeadPack::class    => [
            NewLeadPackListener::class,
        ],
//        NewContact::class     => [
//            NewContactListener::class,
//        ],
        NewContactPack::class => [
            NewContactPackListener::class,
        ],
    ];
}