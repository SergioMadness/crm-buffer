<?php namespace professionalweb\IntegrationHub\Drivers\PartnerBox\Models;

use professionalweb\IntegrationHub\Subsystems\CRMBuffer\Traits\HasPlugins;
use professionalweb\IntegrationHub\Subsystems\CRMBuffer\Abstractions\Driver as ADriver;

/**
 * Class describes PartnerBox driver
 * @package professionalweb\IntegrationHub\Drivers\PartnerBox
 */
class PartnerBoxDriver extends ADriver
{
    use HasPlugins;

    /**
     * Get driver name
     *
     * @return string
     */
    public function getName(): string
    {
        return 'PartnerBox';
    }

    /**
     * Get driver alias
     *
     * @return string
     */
    public function getAlias(): string
    {
        return 'partnerbox';
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
     * Get driver settings
     *
     * @return array
     */
    public function getSettings(): array
    {
        return [
            'server_url'               => [
                'name' => 'Url сервиса',
                'type' => 'string',
            ],
            'sale_url'                 => [
                'name' => 'Sales url',
                'type' => 'string',
            ],
            'login'                    => [
                'name' => 'Логин',
                'type' => 'string',
            ],
            'password'                 => [
                'name' => 'Пароль',
                'type' => 'password',
            ],
            'account_id'               => [
                'name' => 'Account id',
                'type' => 'string',
            ],
            'lead_event_name'          => [
                'name' => 'Lead event name',
                'type' => 'string',
            ],
            'lead_event_product_id'    => [
                'name' => 'Lead event product id',
                'type' => 'string',
            ],
            'contact_event_name'       => [
                'name' => 'Contact event name',
                'type' => 'string',
            ],
            'contact_event_product_id' => [
                'name' => 'Contact event product id',
                'type' => 'string',
            ],
        ];
    }
}