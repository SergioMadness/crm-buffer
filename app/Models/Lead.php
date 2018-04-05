<?php namespace App\Models;

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
    }
}