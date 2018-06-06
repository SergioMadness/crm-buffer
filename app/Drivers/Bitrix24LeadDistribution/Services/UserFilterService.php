<?php namespace App\Drivers\Bitrix24LeadDistribution\Services;

use App\Drivers\Bitrix24LeadDistribution\Filter;

/**
 * Service for user filtration
 * @package App\Drivers\Bitrix24LeadDistribution\Services
 */
class UserFilterService implements Filter
{

    /**
     * Get user id by filter
     *
     * @param array $filter
     * @param array $params
     *
     * @return array
     */
    public function getUserIds(array $filter, array $params): array
    {
        $result = [];
        $conditions = $filter['conditions'] ?? [];

        if (!empty($conditions)) {
            foreach ($conditions as $condition) {
                $field = $condition['field'] ?? null;
                $operation = $condition['operation'] ?? null;
                $value1 = $condition['value'] ?? null;
                $value2 = $condition['value2'] ?? null;
                $success = $condition['success'] ?? null;
                $filterResult = $condition['result'] ?? null;

                if ($field !== null && isset($params[$field]) && $this->checkCondition($params[$field], $operation, $value1, $value2)) {
                    if ($success !== null) {
                        $result = array_merge($result, $this->getUserIds($success, $params));
                    } else {
                        $result = array_merge($result, $filterResult);
                    }
                }
            }
        }

        return array_unique($result);
    }

    /**
     * Check condition
     *
     * @param $value
     * @param $condition
     * @param $value1
     * @param $value2
     *
     * @return bool
     */
    protected function checkCondition($value, $condition, $value1, $value2): bool
    {
        $result = false;
        $conditions = explode('|', $condition);
        $invert = \in_array(self::CONDITION_NOT, $conditions);
        switch ($condition) {
            case self::CONDITION_EQUAL:
                $result = ($value === $value1);
                break;
            case self::CONDITION_IN:
                $result = \in_array($value, (array)$value1);
                break;
            case self::CONDITION_LESS:
                $result = ($value < $value1);
                break;
            case self::CONDITION_MORE:
                $result = ($value > $value1);
                break;
            case self::CONDITION_MORE . '|' . self::CONDITION_EQUAL:
            case self::CONDITION_EQUAL . '|' . self::CONDITION_MORE:
                $result = ($value >= $value1);
                break;
            case self::CONDITION_LESS . '|' . self::CONDITION_EQUAL:
            case self::CONDITION_EQUAL . '|' . self::CONDITION_LESS:
                $result = ($value <= $value1);
                break;
            case self::CONDITION_BETWEEN:
                $result = (($value >= $value1) && ($value <= $value2));
                break;
        }

        return $invert ? !$result : $result;
    }
}