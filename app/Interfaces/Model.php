<?php namespace App\Interfaces;

/**
 * Basic interface for system model
 * @package App\Interfaces
 */
interface Model
{
    /**
     * Save model
     *
     * @param array $options
     *
     * @return bool
     */
    public function save(array $options = []);

    /**
     * Delete model
     *
     * @return bool
     */
    public function delete();
}