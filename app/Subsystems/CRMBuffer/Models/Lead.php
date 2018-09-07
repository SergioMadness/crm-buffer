<?php namespace App\Subsystems\CRMBuffer\Models;

use App\Models\Request;
use Illuminate\Database\Eloquent\Builder;

/**
 * Lead
 * @package App\Models
 */
class Lead extends Request
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->request_type = self::TYPE_LEAD;

        static::addGlobalScope('request_type', function (Builder $builder) {
            $builder->where('request_type', $this->request_type);
        });
    }
}