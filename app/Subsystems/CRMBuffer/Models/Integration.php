<?php namespace professionalweb\IntegrationHub\Subsystems\CRMBuffer\Models;

use professionalweb\IntegrationHub\Abstractions\UUIDModel;
use professionalweb\IntegrationHub\Interfaces\Model as IModel;
use professionalweb\IntegrationHub\Subsystems\CRMBuffer\Interfaces\Models\Integration as IIntegration;

/**
 * Integration
 * @package professionalweb\IntegrationHub\Models
 *
 * @property string $id
 * @property string $name
 * @property string $driver
 * @property bool   $is_active
 * @property array  $settings
 * @property string $created_at
 * @property string $updated_at
 */
class Integration extends UUIDModel implements IModel, IIntegration
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

    /**
     * Get alias
     *
     * @return string
     */
    public function getAlias(): string
    {
        return $this->driver . '_' . $this->id;
    }

    /**
     * Get integration settings
     *
     * @return array
     */
    public function getSettings(): array
    {
        return (array)$this->settings;
    }
}