<?php namespace App\Drivers\PartnerBox;

use App\Events\NewLead;
use App\Events\NewContact;
use App\Events\NewLeadPack;
use App\Events\NewContactPack;
use Laravel\Lumen\Providers\EventServiceProvider;
use App\Drivers\PartnerBox\Listeners\NewLeadListener;
use App\Drivers\PartnerBox\Listeners\NewContactListener;
use App\Drivers\PartnerBox\Listeners\NewLeadPackListener;
use App\Drivers\PartnerBox\Listeners\NewContactPackListener;

class EventProvider extends EventServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        NewLead::class        => [
            NewLeadListener::class,
        ],
        NewLeadPack::class    => [
            NewLeadPackListener::class,
        ],
        NewContact::class     => [
            NewContactListener::class,
        ],
        NewContactPack::class => [
            NewContactPackListener::class,
        ],
    ];
}