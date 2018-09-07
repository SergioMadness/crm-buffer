<?php namespace App\Subsystems\IntegrationHub\Repositories;

use App\Subsystems\IntegrationHub\Interfaces\Model;
use App\Subsystems\IntegrationHub\Models\Application;
use App\Subsystems\IntegrationHub\Interfaces\Repositories\ApplicationRepository as IApplicationRepository;

/**
 * Application repository
 * @package App\Repositories
 */
class ApplicationRepository extends BaseRepository implements IApplicationRepository
{

    public function __construct()
    {
        $this->setModelClass(Application::class);
    }

    /**
     * Get application by clientId
     *
     * @param string $clientId
     *
     * @return Application|null
     */
    public function getByClientId(string $clientId): ?Application
    {
        return Application::query()->where('client_id', $clientId)->first();
    }

    /**
     * Create model
     *
     * @param array $attributes
     *
     * @return Model
     */
    public function create(array $attributes = []): Model
    {
        $model = parent::create($attributes);

        $this->setNewKeys($model);

        return $model;
    }

    /**
     * Set new keys to model
     *
     * @param Application $model
     *
     * @return Application
     */
    protected function setNewKeys(Application $model): Application
    {
        $model->client_id = md5(time() . str_random());
        $model->client_secret = md5(time() . str_random());

        return $model;
    }

    /**
     * Generate new tokens
     *
     * @param Application $model
     *
     * @return Application
     */
    public function generateKeys(Application $model): Application
    {
        $this->setNewKeys($model)->save();

        return $model;
    }
}