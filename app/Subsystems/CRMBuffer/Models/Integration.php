<?php namespace App\Subsystems\CRMBuffer\Models;

use App\Abstractions\UUIDModel;
use App\Interfaces\Model as IModel;

/**
 * Integration
 * @package App\Models
 *
 * @property string $id
 * @property string $name
 * @property string $driver
 * @property bool   $is_active
 * @property array  $settings
 * @property string $created_at
 * @property string $updated_at
 */
class Integration extends UUIDModel implements IModel
{
    protected $table = 'integrations';

    protected $fillable = [
        'name',
        'driver',
        'is_active',
        'settings',
    ];

    protected $casts = [
        'settings'  => 'array',
        'is_active' => 'bool',
    ];

    protected $visible = [
        'id',
        'name',
        'driver',
        'is_active',
        'settings',
    ];

    /**
     * Get settings value
     *
     * @param string $alias
     *
     * @return mixed|null
     */
    public function getSettingsValue(string $alias)
    {
        return $this->settings[$alias] ?? null;
    }
}