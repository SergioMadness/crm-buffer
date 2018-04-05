<?php namespace App\Repositories;

use App\Interfaces\Model;
use App\Models\Application;
use App\Interfaces\Repositories\ApplicationRepository as IApplicationRepository;

/**
 * Application repository
 * @package App\Repositories
 */
class ApplicationRepository implements IApplicationRepository
{

    /**
     * Create model
     *
     * @param array $attributes
     *
     * @return Model
     */
    public function create(array $attributes = []): Model
    {
        return new Application($attributes);
    }

    /**
     * Save model
     *
     * @param Model $model
     *
     * @return bool
     */
    public function save(Model $model): bool
    {
        return $model->save();
    }

    /**
     * Remove model
     *
     * @param Model $model
     *
     * @return bool
     */
    public function remove(Model $model): bool
    {
        return $model->delete();
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
}