<?php namespace App\Repositories;

use App\Models\User;
use App\Interfaces\Models\Token;
use App\Interfaces\Models\User as IUser;
use App\Interfaces\Repositories\UserRepository as IUserRepository;

/**
 * User repository
 * @package App\Repositories
 */
class UserRepository extends BaseRepository implements IUserRepository
{
    /**
     * @var string
     */
    private $adminLogin;

    /**
     * @var string
     */
    private $adminPassword;

    public function __construct(?string $login = null, ?string $password = null)
    {
        $this->setModelClass(User::class)
            ->setLogin($login)
            ->setPassword($password);
    }

    /**
     * Get user by token
     *
     * @param string $token
     *
     * @return IUser
     */
    public function getByToken(string $token): ?IUser
    {
        /** @var \App\Interfaces\Models\User $user */
        $user = $this->create();
        if ($token === $user->generateToken()->getToken()) {
            return $user;
        }

        return null;
    }

    /**
     * Refresh user token
     *
     * @param string $token
     * @param string $refreshToken
     *
     * @return Token
     */
    public function refreshToken(string $token, string $refreshToken): Token
    {

    }

    /**
     * Get user by login and password
     *
     * @param string $login
     * @param string $password
     *
     * @return IUser|null
     */
    public function getByCredentials(string $login, string $password): ?IUser
    {
        if ($login === $this->getLogin() && $password === $this->getPassword()) {
            return new User([], $this->getLogin(), $this->getPassword());
        }

        return null;
    }

    /**
     * @return string
     */
    public function getLogin(): string
    {
        return $this->adminLogin;
    }

    /**
     * @param string $login
     *
     * @return $this
     */
    public function setLogin(string $login): self
    {
        $this->adminLogin = $login;

        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->adminPassword;
    }

    /**
     * @param string $password
     *
     * @return $this
     */
    public function setPassword(string $password): self
    {
        $this->adminPassword = $password;

        return $this;
    }
}