<?php namespace App\Drivers\Bitrix24LeadDistribution\Algorithms;

use Illuminate\Support\Facades\Cache;
use App\Drivers\Bitrix24LeadDistribution\Interfaces\DistributionAlgorithm;

/**
 * Round robin implementation
 * @package App\Drivers\Bitrix24LeadDistribution\Algorithms
 */
class RoundRobin implements DistributionAlgorithm
{
    /**
     * Get map user->leadQty
     *
     * @return array
     */
    protected function getMap(): array
    {
        $map = Cache::get('rr_map', [
            'values' => [],
            'date'   => date('d.m.Y'),
        ]);
        if ($map['date'] !== date('d.m.Y')) {
            $map['values'] = [];
        }

        return $map['values'];
    }

    /**
     * Remember map
     *
     * @param array $map
     *
     * @return RoundRobin
     */
    protected function setMap(array $map): self
    {
        Cache::forever('rr_map', [
            'values' => $map,
            'date'   => date('d.m.Y'),
        ]);

        return $this;
    }

    /**
     * Get user id
     *
     * @param array $ids
     *
     * @return mixed
     */
    public function getUserId(array $ids)
    {
        $map = $this->getMap();

        $result = null;
        $minQty = null;
        foreach ($ids as $id) {
            if (!isset($map[$id])) {
                $result = $id;
                $map[$id] = 0;
                break;
            }

            if ($minQty === null || $minQty > $map[$id]) {
                $minQty = $map[$id];
                $result = $id;
            }
        }
        $map[$result]++;

        $this->setMap($map);

        return $result;
    }
}