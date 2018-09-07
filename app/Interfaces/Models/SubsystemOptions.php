<?php namespace App\Interfaces\Models;

/**
 * Interface for subsystem settings
 * @package App\Interfaces\Models
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