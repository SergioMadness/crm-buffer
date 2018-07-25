<?php namespace App\Drivers\PartnerBox\Models;

use App\Subsystems\CRMBuffer\Interfaces\Models\Driver;

/**
 * Class describes PartnerBox driver
 * @package App\Drivers\PartnerBox
 */
class PartnerBoxDriver implements Driver
{

    private $settings = [
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