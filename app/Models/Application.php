<?php namespace App\Models;

use App\Abstractions\UUIDModel;
use App\Interfaces\Model as IModel;

/**
 * Application
 * @package App\Models
 *
 * @property string $id
 * @property string $client_id
 * @property string $client_secret
 * @property string $created_at
 * @property string $updated_at
 */
class Application extends UUIDModel implements IModel
{
    protected $table = 'applications';

    protected $fillable = [
        'name',
    ];
}