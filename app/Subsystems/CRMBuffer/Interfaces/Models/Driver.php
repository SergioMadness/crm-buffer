<?php namespace App\Subsystems\CRMBuffer\Interfaces\Models;

/**
 * Interface for driver
 * @package App\Subsystems\CRMBuffer\Interfaces\Models
 */
interface Driver
{
    /**
     * Get driver alias
     *
     * @return string
     */
    public function getAlias(): string;

    /**
     * Get available settings
     *
     * @return array
     */
    public function getSettings(): array;

    /**
     * Add available settings
     *
     * @param array $settings
     *
     * @return Driver
     */
    public function addSettings(array $settings): self;
}