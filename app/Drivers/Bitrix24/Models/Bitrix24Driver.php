<?php namespace professionalweb\IntegrationHub\Drivers\Bitrix24\Models;

use professionalweb\IntegrationHub\Subsystems\CRMBuffer\Traits\HasPlugins;
use professionalweb\IntegrationHub\Subsystems\CRMBuffer\Abstractions\Driver as ADriver;

/**
 * Class describes Bitrix24 driver
 * @package professionalweb\IntegrationHub\Drivers\Bitrix24\Models
 */
class Bitrix24Driver extends ADriver
{
    use HasPlugins;

    /**
     * Get driver name
     *
     * @return string
     */
    public function getName(): string
    {
        return 'Bitrix24';
    }

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
     * Get fields available in service
     *
     * @return array
     */
    public function getAvailableFields(): array
    {
        return [];
    }

    /**
     * Get available settings
     *
     * @return array
     */
    public function getSettings(): array
    {
        return [
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
    }
}