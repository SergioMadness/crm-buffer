<?php namespace App\Interfaces\Services;

/**
 * Interface for subsytem to resolve path
 * @package App\Interfaces\Services
 */
interface ConditionSubsystem
{
    /**
     * Resolve path by conditions
     *
     * @param array $conditions
     *
     * @return int
     */
    public function getPath(array $conditions): int;
}