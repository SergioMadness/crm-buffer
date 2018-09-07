<?php namespace App\Models;

use App\Abstractions\UUIDModel;
use Illuminate\Database\Eloquent\SoftDeletes;

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