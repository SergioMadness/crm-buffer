<?php namespace App\Subsystems\IntegrationHubCommon\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Subsystems\IntegrationHubCommon\Abstractions\UUIDModel;

/**
 * Process flow model
 * @package App\Models
 *
 * @property string  $id
 * @property string  $name
 * @property array   $data
 * @property boolean $is_default
 * @property boolean $is_active
 * @property string  $created_at
 * @property string  $updated_at
 * @property string  $deleted_at
 */
class Flow extends UUIDModel
{
    use SoftDeletes;

    protected $table = 'flow';

    public $keyType = 'string';

    protected $casts = [
        'data' => 'array',
    ];
}