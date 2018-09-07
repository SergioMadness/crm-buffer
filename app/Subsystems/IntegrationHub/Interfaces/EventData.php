<?php namespace App\Subsystems\IntegrationHub\Interfaces;

/**
 * Interface for object has data
 * @package App\Subsystems\IntegrationHub\Interfaces
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