<?php namespace App\Events;

/**
 * New contact pack event
 * @package App\Events
 */
class NewContactPack extends Event
{
    public $contactsData;

    public function __construct(array $data)
    {
        $this->contactsData = $data;
    }
}