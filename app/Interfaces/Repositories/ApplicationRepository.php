<?php namespace App\Interfaces\Repositories;

use App\Models\Application;
use App\Interfaces\Repository;

/**
 * Interface for application repository
 * @package App\Interfaces\Repositories
 */
interface ApplicationRepository extends Repository
{
    /**
     * Get application by clientId
     *
     * @param string $clientId
     *
     * @return Application|null
     */
    public function getByClientId(string $clientId): ?Application;

    /**
     * Generate new tokens
     *
     * @param Application $model
     *
     * @return Application
     */
    public function generateKeys(Application $model): Application;
}