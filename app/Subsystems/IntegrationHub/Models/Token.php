<?php namespace App\Subsystems\IntegrationHub\Models;

use App\Subsystems\IntegrationHubDB\Interfaces\Model;
use App\Subsystems\IntegrationHub\Interfaces\Models\Token as IToken;

/**
 * Token
 * @package App\Models
 */
class Token implements Model, IToken
{
    /**
     * @var string
     */
    private $token;

    /**
     * @var string
     */
    private $refreshToken;

    public function __construct()
    {
        $this->token = md5(config('app.login'));
        $this->refreshToken = md5(config('app.password'));
    }

    /**
     * Save model
     *
     * @param array $options
     *
     * @return bool
     */
    public function save(array $options = [])
    {
        return true;
    }

    /**
     * Delete model
     *
     * @return bool
     */
    public function delete()
    {
        return true;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @param string $token
     *
     * @return $this
     */
    public function setToken(string $token): self
    {
        $this->token = $token;

        return $this;
    }

    /**
     * @return string
     */
    public function getRefreshToken(): string
    {
        return $this->refreshToken;
    }

    /**
     * @param string $refreshToken
     *
     * @return Token
     */
    public function setRefreshToken(string $refreshToken): self
    {
        $this->refreshToken = $refreshToken;

        return $this;
    }


    /**
     * Fill model
     *
     * @param array $attributes
     *
     * @return $this
     */
    public function fill(array $attributes)
    {
        return $this;
    }
}