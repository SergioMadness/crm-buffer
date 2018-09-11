<?php namespace App\Subsystems\IntegrationHubDB\Interfaces\Models;

/**
 * Interface for subsystem settings
 * @package App\Subsystems\IntegrationHubDB\Interfaces\Models
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