<?php namespace App\Drivers\Bitrix24\Models;

use App\Subsystems\CRMBuffer\Interfaces\Models\Driver;

/**
 * Class describes Bitrix24 driver
 * @package App\Drivers\Bitrix24\Models
 */
class Bitrix24Driver implements Driver
{

    protected $settings = [
        'url'              => [
            'name' => 'Домен',
            'type' => 'string',
        ],
        'hook'             => [
            'name' => 'Hook',
            'type' => 'string',
        ],
        'client_id'        => [
            'name' => 'Client id',
            'type' => 'string',
        ],
        'client_secret'    => [
            'name' => 'Client secret',
            'type' => 'string',
        ],
        'access_token'     => [
            'name' => 'Access token',
            'type' => 'string',
        ],
        'refresh_token'    => [
            'name' => 'Refresh token',
            'type' => 'string',
        ],
        'check_duplicates' => [
            'name' => 'Помечать дубликаты',
            'type' => 'bool',
        ],
        'duplicate_status' => [
            'name' => 'ID статуса дубликата',
            'type' => 'string',
        ],
    ];

    /**
     * Get driver alias
     *
     * @return string
     */
    public function getAlias(): string
    {
        return 'bitrix';
    }

    /**
     * Get available settings
     *
     * @return array
     */
    public function getSettings(): array
    {
        return $this->settings;
    }

    /**
     * Add available settings
     *
     * @param array $settings
     *
     * @return Driver
     */
    public function addSettings(array $settings): Driver
    {
        $this->settings = array_merge($this->settings, $settings);

        return $this;
    }

    /**
     * Get fields available in service
     *
     * @return array
     */
    public function getAvailableFields(): array
    {
        return [];
    }
}