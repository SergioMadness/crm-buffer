<?php namespace App\Subsystems\IntegrationHubCommon\Abstractions;

use Ramsey\Uuid\Uuid;
use Illuminate\Database\Eloquent\Model;

/**
 * Basic class for models with uuid IDs
 * @package App\Subsystems\IntegrationHubCommon\Abstractions
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
            /** @var UUIDModel $model */
            if (empty($model->id)) {
                $model->generateId();
            }
        });
    }

    /**
     * generate UUID
     *
     * @return string
     * @throws \Exception
     */
    public function generateId(): string
    {
        return $this->id = Uuid::uuid4();
    }
}