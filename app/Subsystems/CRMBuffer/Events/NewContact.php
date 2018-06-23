<?php namespace App\Subsystems\CRMBuffer\Events;

use App\Events\Event;

/**
 * New contact event
 * @package App\Events
 */
class NewContact extends Event
{
    public $id;

    public $data;

    public function __construct($id, array $data)
    {
        $this->id = $id;
        $this->data = $data;
    }
}