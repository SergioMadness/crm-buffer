<?php namespace professionalweb\IntegrationHub\Drivers\Bitrix24LeadDistribution\Services;

use professionalweb\IntegrationHub\Drivers\Bitrix24LeadDistribution\Interfaces\Filter;

/**
 * Service for user filtration
 * @package professionalweb\IntegrationHub\Drivers\Bitrix24LeadDistribution\Services
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
        if (!empty($filter)) {
            foreach ($filter as $condition) {
                $field = $condition['field'] ? mb_strtolower($condition['field']) : null;
                $operation = $condition['operation'] ?? null;
                $value1 = $condition['value1'] ?? null;
                $value2 = $condition['value2'] ?? null;
                $success = $condition['success'] ?? null;
                $filterResult = $condition['result'] ?? null;

                $value = $params[$field] ?? ($params[mb_strtoupper($field)] ?? '');
                if ($field !== null && $this->checkCondition($value, $operation, $value1, $value2)) {
                    return $success !== null ? $this->getUserIds($success, $params) : $filterResult;
                }
            }
        }

        return [];
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
        $value = \is_string($value) ? mb_strtolower($value) : $value;
        $value1 = \is_string($value1) ? mb_strtolower($value1) : $value1;
        if ($value2 !== null) {
            $value2 = \is_string($value2) ? mb_strtolower($value2) : $value2;
        }
        $conditions = explode('|', $condition);
        $invert = \in_array(self::CONDITION_NOT, $conditions);
        $conditions = array_filter($conditions, function ($item) {
            return $item !== self::CONDITION_NOT;
        });
        $condition = implode('|', $conditions);
        switch ($condition) {
            case self::CONDITION_EQUAL:
                $result = ($value == $value1);
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