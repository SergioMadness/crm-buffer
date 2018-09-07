<?php namespace App\Subsystems\IntegrationHub\Interfaces\Models;

/**
 * Interface for token model
 * @package App\Subsystems\IntegrationHub\Interfaces\Models
 */
interface Token
{
    /**
     * Get token
     *
     * @return string
     */
    public function getToken(): string;

    /**
     * Get refresh token
     *
     * @return string
     */
    public function getRefreshToken(): string;
}