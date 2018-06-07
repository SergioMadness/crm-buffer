<?php namespace App\Drivers\Bitrix24LeadDistribution\Services;

use App\Drivers\Bitrix24LeadDistribution\Interfaces\Filter;
use App\Drivers\Bitrix24LeadDistribution\Interfaces\DistributionAlgorithm;
use App\Drivers\Bitrix24LeadDistribution\Interfaces\DistributionService as IDistributionService;

/**
 * Service to distribute leads between users
 * @package App\Drivers\Bitrix24LeadDistribution\Services
 */
class DistributionService implements IDistributionService
{

    /**
     * @var DistributionAlgorithm
     */
    private $algorithm;

    /**
     * @var Filter
     */
    private $filter;

    /**
     * Set service to filter user
     *
     * @param Filter $filter
     *
     * @return $this
     */
    public function setFilter(Filter $filter): self
    {
        $this->filter = $filter;

        return $this;
    }

    /**
     * Get filter
     *
     * @return Filter
     */
    public function getFilter(): Filter
    {
        return $this->filter;
    }

    /**
     * Set selected algorithm
     *
     * @param DistributionAlgorithm $algorithm
     *
     * @return DistributionService
     */
    public function setAlgorithm(DistributionAlgorithm $algorithm): self
    {
        $this->algorithm = $algorithm;

        return $this;
    }

    /**
     * Get algorithm
     *
     * @return DistributionAlgorithm
     */
    public function getAlgorithm(): ?DistributionAlgorithm
    {
        return $this->algorithm;
    }

    /**
     * Get user id
     *
     * @param array $filter
     * @param array $params
     *
     * @return mixed
     */
    public function getUserId(array $filter, array $params)
    {
        if (($alg = $this->getAlgorithm()) !== null) {
            return $alg->getUserId(
                $this->getFilter()->getUserIds($filter, $params)
            );
        }

        return null;
    }
}