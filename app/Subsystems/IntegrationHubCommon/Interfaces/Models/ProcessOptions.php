<?php namespace App\Subsystems\IntegrationHubCommon\Interfaces\Models;

/**
 * Subsystem settings
 * @package App\Subsystems\IntegrationHubCommon\Interfaces\Models
 */
interface ProcessOptions
{
    /**
     * Get data mapping
     *
     * @return array
     */
    public function getMapping(): array;

    /**
     * Get process options
     *
     * @return array
     */
    public function getOptions(): array;
}