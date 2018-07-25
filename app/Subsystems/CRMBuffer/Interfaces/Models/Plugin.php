<?php namespace App\Subsystems\CRMBuffer\Interfaces\Models;

/**
 * Interface for plugin
 * @package App\Subsystems\CRMBuffer\Interfaces\Models
 */
interface Plugin
{
    /**
     * Get alias plugin
     *
     * @return string
     */
    public function getAlias(): string;

    /**
     * Get driver plugin for
     *
     * @return string
     */
    public function getDriver(): string;

    /**
     * Get plugin available settings
     *
     * @return array
     */
    public function getSettings(): array;
}