<?php namespace App\Subsystems\IntegrationHubCommon\Interfaces;

/**
 * Interface for object has data
 * @package App\Subsystems\IntegrationHubCommon\Interfaces
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