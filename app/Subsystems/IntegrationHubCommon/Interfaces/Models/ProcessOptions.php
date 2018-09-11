<?php namespace App\Subsystems\IntegrationHubDB\Interfaces\Models;

/**
 * Subsystem settings
 * @package App\Subsystems\IntegrationHubDB\Interfaces\Models
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

    /**
     * Processor is remote
     *
     * @return bool
     */
    public function isRemote(): bool;

    /**
     * Get queue name to send event to processor through queue
     *
     * @return string
     */
    public function getQueue(): string;

    /**
     * Get host to send event to processor through REST API
     *
     * @return string
     */
    public function getHost(): string;
}