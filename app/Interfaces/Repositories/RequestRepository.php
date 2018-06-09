<?php namespace App\Interfaces\Repositories;

use App\Interfaces\Repository;
use Illuminate\Support\Collection;

/**
 * Interface for repository of requests
 * @package App\Interfaces
 */
interface RequestRepository extends Repository
{
    /**
     * Get pack of requests
     *
     * @param int $size
     *
     * @return Collection
     */
    public function getPack(int $size = 10): Collection;

    /**
     * Set request status
     *
     * @param string $id
     * @param string $status
     * @param mixed  $message
     * @param string $system
     *
     * @return bool
     */
    public function setStatus(string $id, string $status, $message = '', string $system = ''): bool;
}