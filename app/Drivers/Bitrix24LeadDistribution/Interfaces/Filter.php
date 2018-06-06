<?php namespace App\Drivers\Bitrix24LeadDistribution;

/**
 * Interface for user filtration service
 * @package App\Drivers\Bitrix24LeadDistribution
 */
interface Filter
{
    public const CONDITION_EQUAL = '=';

    public const CONDITION_MORE = '>';

    public const CONDITION_LESS = '<';

    public const CONDITION_NOT = '!';

    public const CONDITION_BETWEEN = 'between';

    public const CONDITION_IN = 'in';

    /**
     * Get user id bu filter
     *
     * @param array $filter
     * @param array $params
     *
     * @return array
     */
    public function getUserIds(array $filter, array $params): array;
}