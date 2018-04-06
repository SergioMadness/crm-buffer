<?php namespace App\Interfaces\Models;

use App\Interfaces\Model;

/**
 * Interface for user model
 * @package App\Interfaces\Models
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