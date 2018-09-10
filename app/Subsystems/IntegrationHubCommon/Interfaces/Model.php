<?php namespace App\Subsystems\IntegrationHubCommon\Interfaces;

/**
 * Basic interface for system model
 * @package App\Subsystems\IntegrationHubCommon\Interfaces
 */
interface Model
{
    /**
     * Fill model
     *
     * @param array $attributes
     *
     * @return $this
     */
    public function fill(array $attributes);

    /**
     * Save model
     *
     * @param array $options
     *
     * @return bool
     */
    public function save(array $options = []);

    /**
     * Delete model
     *
     * @return bool
     */
    public function delete();
}