<?php namespace App\Subsystems\IntegrationHub\Repositories;

use Illuminate\Support\Collection;
use Illuminate\Database\Query\Builder;
use App\Subsystems\IntegrationHub\Interfaces\Model;
use App\Subsystems\IntegrationHub\Interfaces\Repository;

/**
 * Basic abstract repository
 * @package App\Repositories
 */
abstract class BaseRepository implements Repository
{
    /**
     * @var string
     */
    private $modelClass;

    /**
     * Count items by filter
     *
     * @param array $filters
     *
     * @return int
     */
    public function count(array $filters = []): int
    {
        $modelClass = $this->getModelClass();
        /** @var Builder $query */
        $query = $modelClass::query();

        if (!empty($filters)) {
            $query->where($filters);
        }

        return $query->count();
    }

    /**
     * Get data
     *
     * @param array    $filters
     * @param array    $sort
     * @param int|null $limit
     * @param int|null $offset
     *
     * @return Collection
     */
    public function get(array $filters = [], array $sort = [], ?int $limit = null, ?int $offset = null): Collection
    {
        $modelClass = $this->getModelClass();
        /** @var Builder $query */
        $query = $modelClass::query();

        if (!empty($filters)) {
            $query->where($filters);
        }
        foreach ($sort as $column => $direction) {
            $query->orderBy($column, $direction);
        }
        if ($limit !== null) {
            $query->limit($limit);
        }
        if ($offset !== null) {
            $query->offset($offset);
        }

        return $query->get();
    }

    /**
     * Get model by id
     *
     * @param string|int $id
     *
     * @return Model|null
     */
    public function model($id): ?Model
    {
        $class = $this->getModelClass();

        return $class::find($id);
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
        $className = $this->getModelClass();

        return new $className($attributes);
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
     * Fill model
     *
     * @param Model $model
     * @param array $attributes
     *
     * @return Model
     */
    public function fill(Model $model, array $attributes = []): Model
    {
        return $model->fill($attributes);
    }

    /**
     * Set model class
     *
     * @param string $className
     *
     * @return BaseRepository
     */
    public function setModelClass(string $className): self
    {
        $this->modelClass = $className;

        return $this;
    }

    /**
     * Get model class
     *
     * @return string
     */
    public function getModelClass(): string
    {
        return $this->modelClass;
    }
}