<?php namespace App\Subsystems\CRMBuffer\Events;

use App\Events\Event;

/**
 * New lead event
 * @package App\Events
 */
class NewLead extends Event
{
    public $id;

    public $data;

    public function __construct($id, array $data)
    {
        $this->id = $id;
        $this->data = $data;
    }
}