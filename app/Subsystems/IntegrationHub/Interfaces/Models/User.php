<?php namespace App\Subsystems\IntegrationHub\Interfaces\Models;

use App\Subsystems\IntegrationHubCommon\Interfaces\Model;

/**
 * Interface for user model
 * @package App\Subsystems\IntegrationHub\Interfaces\Models
 */
interface User extends Model
{
    /**
     * Generate token
     *
     * @return Token
     */
    public function generateToken(): Token;
}