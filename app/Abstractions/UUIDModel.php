<?php namespace App\Abstractions;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

/**
 * Basic class for models with uuid IDs
 * @package App\Abstractions
 */
abstract class UUIDModel extends Model
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->keyType = 'string';
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = Uuid::uuid4();
        });
    }
}