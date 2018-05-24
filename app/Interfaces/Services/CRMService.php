<?php namespace App\Interfaces\Services;

/**
 * Interface to work with crm
 * @package App\Interfaces\Services
 */
interface CRMService
{
    /**
     * Set service settings
     *
     * @param array $settings
     *
     * @return CRMService
     */
    public function setSettings(array $settings): self;

    /**
     * Send lead to CRM
     *
     * @param array $data
     *
     * @return bool
     */
    public function sendLead(array $data): bool;

    /**
     * Send contact to CRM
     *
     * @param array $data
     *
     * @return bool
     */
    public function sendContact(array $data): bool;

    /**
     * Get response messages/errors
     *
     * @return array
     */
    public function getMessages(): array;

    /**
     * Check last request was successful
     *
     * @return bool
     */
    public function isSuccess(): bool;
}