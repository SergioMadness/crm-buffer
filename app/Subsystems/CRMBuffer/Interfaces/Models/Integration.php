<?php namespace professionalweb\IntegrationHub\Subsystems\CRMBuffer\Interfaces\Models;

/**
 * Interface for integration model
 * @package professionalweb\IntegrationHub\Subsystems\CRMBuffer\Interfaces\Models
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