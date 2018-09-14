<?php namespace professionalweb\IntegrationHub\Drivers\Bitrix24LeadDistribution\Interfaces;

/**
 * Interface for distribution service
 * @package professionalweb\IntegrationHub\Drivers\Bitrix24LeadDistribution\Interfaces
 */
interface DistributionService
{
    /**
     * Get user id
     *
     * @param array $filter
     * @param array $params
     *
     * @return mixed
     */
    public function getUserId(array $filter, array $params);
}