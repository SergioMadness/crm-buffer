<?php namespace App\Subsystems\IntegrationHub\Interfaces\Models;

/**
 * Interface for subsystem settings
 * @package App\Subsystems\IntegrationHub\Interfaces\Models
 */
interface SubsystemOptions
{
    /**
     * Get available fields for mapping
     *
     * @return array
     */
    public function getAvailableFields(): array;

    /**
     * Get service settings
     *
     * @return array
     */
    public function getOptions(): array;
}