<?php namespace App\Interfaces;

use Illuminate\Support\Collection;

/**
 * Basic repository
 * @package App\Interfaces
 */
interface Repository
{
    /**
     * Create model
     *
     * @param array $attributes
     *
     * @return Model
     */
    public function create(array $attributes = []): Model;

    /**
     * Save model
     *
     * @param Model $model
     *
     * @return bool
     */
    public function save(Model $model): bool;

    /**
     * Remove model
     *
     * @param Model $model
     *
     * @return bool
     */
    public function remove(Model $model): bool;

    /**
     * Fill model
     *
     * @param Model $model
     * @param array $attributes
     *
     * @return Model
     */
    public function fill(Model $model, array $attributes = []): Model;

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
    public function get(array $filters = [], array $sort = [], ?int $limit = null, ?int $offset = null): Collection;

    /**
     * Get model by id
     *
     * @param string|int $id
     *
     * @return Model|null
     */
    public function model($id): ?Model;
}