<?php namespace App\Subsystems\IntegrationHub\Models;

use App\Subsystems\IntegrationHubCommon\Abstractions\UUIDModel;
use App\Subsystems\IntegrationHubCommon\Interfaces\Model as IModel;

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