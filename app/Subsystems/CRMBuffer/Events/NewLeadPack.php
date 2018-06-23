<?php namespace App\Subsystems\CRMBuffer\Events;

use App\Events\Event;

/**
 * New lead pack event
 * @package App\Events
 */
class NewLeadPack extends Event
{
    public $leadsData;

    public function __construct(array $data)
    {
        $this->leadsData = $data;
    }
}