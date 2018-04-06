<?php namespace App\Models;

use App\Interfaces\Model;
use App\Interfaces\Models\User as IUser;
use App\Interfaces\Models\Token as IToken;
use Illuminate\Contracts\Support\Arrayable;

/**
 * User
 * @package App\Models
 */
class User implements Model, IUser, Arrayable
{
    /**
     * @var string
     */
    private $login;

    /**
     * @var string
     */
    private $password;

    public function __construct(array $attributes = [], ?string $login = null, ?string $password = null)
    {
        $this
            ->setLogin($login)
            ->setPassword($password);
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
     * Generate token
     *
     * @return Token
     */
    public function generateToken(): IToken
    {
        return new Token();
    }

    /**
     * @return string
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * @param string $login
     *
     * @return $this
     */
    public function setLogin(?string $login): self
    {
        $this->login = $login;

        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     *
     * @return $this
     */
    public function setPassword(?string $password): self
    {
        $this->password = $password;

        return $this;
    }


    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'login' => $this->getLogin(),
        ];
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