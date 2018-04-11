<?php namespace App\Models;

/**
 * Contact
 * @package App\Models
 */
class Contact extends Request
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->request_type = self::TYPE_USER;
    }
}