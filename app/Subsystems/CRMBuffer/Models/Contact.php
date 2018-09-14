<?php namespace professionalweb\IntegrationHub\Subsystems\CRMBuffer\Models;

use professionalweb\IntegrationHub\Models\Request;
use Illuminate\Database\Eloquent\Builder;

/**
 * Contact
 * @package professionalweb\IntegrationHub\Models
 */
class Contact extends Request
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->request_type = self::TYPE_USER;

        static::addGlobalScope('request_type', function (Builder $builder) {
            $builder->where('request_type', $this->request_type);
        });
    }
}