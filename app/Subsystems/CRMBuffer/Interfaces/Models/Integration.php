<?php namespace App\Subsystems\CRMBuffer\Interfaces\Models;

/**
 * Interface for integration model
 * @package App\Subsystems\CRMBuffer\Interfaces\Models
 */
interface Integration
{
    /**
     * Get integration alias
     *
     * @return string
     */
    public function getAlias(): string;

    /**
     * Get integration settings
     *
     * @return array
     */
    public function getSettings(): array;
}