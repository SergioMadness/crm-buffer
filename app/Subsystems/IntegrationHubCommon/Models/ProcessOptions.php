<?php namespace App\Subsystems\IntegrationHubCommon\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Subsystems\IntegrationHubCommon\Abstractions\UUIDModel;

/**
 * Process options
 * @package App\Models
 *
 * @property string $id
 * @property string $name
 * @property array  $mapping
 * @property array  $options
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class ProcessOptions extends UUIDModel
{
    use SoftDeletes;

    protected $table = 'process_options';

    public $keyType = 'string';

    protected $casts = [
        'mapping' => 'array',
        'options' => 'array',
    ];
}