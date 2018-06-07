<?php namespace App\Drivers\Bitrix24LeadDistribution\Interfaces;

/**
 * Interface for distribution algorithms
 * @package App\Drivers\Bitrix24LeadDistribution\Interfaces
 */
interface DistributionAlgorithm
{
    /**
     * Get user id
     *
     * @param array $ids
     *
     * @return mixed
     */
    public function getUserId(array $ids);
}