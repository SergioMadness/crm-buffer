<?php namespace App\Subsystems\IntegrationHub\Interfaces\Repositories;

use App\Subsystems\IntegrationHub\Models\Application;
use App\Subsystems\IntegrationHubCommon\Interfaces\Repository;

/**
 * Interface for application repository
 * @package App\Subsystems\IntegrationHub\Interfaces\Repositories
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