<?php namespace App\Subsystems\IntegrationHub\Abstractions;

use Ramsey\Uuid\Uuid;
use Illuminate\Database\Eloquent\Model;

/**
 * Basic class for models with uuid IDs
 * @package App\Subsystems\IntegrationHub\Abstractions
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