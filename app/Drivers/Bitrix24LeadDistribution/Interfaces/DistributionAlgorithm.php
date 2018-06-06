<?php namespace App\Drivers\Bitrix24LeadDistribution;

/**
 * Interface for distribution algorithms
 * @package App\Drivers\Bitrix24LeadDistribution
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