<?php namespace App\Subsystems\IntegrationHub\Interfaces\Models;

/**
 * Subsystem settings
 * @package App\Subsystems\IntegrationHub\Interfaces\Models
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