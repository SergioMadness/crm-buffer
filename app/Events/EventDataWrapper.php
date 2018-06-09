<?php namespace App\Events;

use App\Interfaces\EventData;

/**
 * Wrapper for event data
 * @package App\Events
 */
class EventDataWrapper implements EventData
{
    /**
     * @var mixed
     */
    public $entity;

    public function __construct($entity)
    {
        $this->setData($entity);
    }

    /**
     * Set data
     *
     * @param $entity
     *
     * @return EventDataWrapper
     */
    public function setData($entity): self
    {
        $this->entity = $entity;

        return $this;
    }

    /**
     * Get data
     *
     * @return mixed
     */
    public function getData()
    {
        return $this->entity;
    }
}