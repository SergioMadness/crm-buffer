<?php namespace App\Events;

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