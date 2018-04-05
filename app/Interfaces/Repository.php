<?php namespace App\Interfaces;

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
}