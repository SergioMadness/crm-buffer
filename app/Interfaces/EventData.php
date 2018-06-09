<?php namespace App\Interfaces;

/**
 * Interface for object has data
 * @package App\Interfaces
 */
interface EventData
{
    /**
     * Get data
     *
     * @return mixed
     */
    public function getData();

    /**
     * Set data
     *
     * @param $data
     *
     * @return mixed
     */
    public function setData($data);
}