<?php namespace App\Drivers\Bitrix24\Interfaces;

/**
 * Interface to work with crm
 * @package App\Drivers\Bitrix24\Interfaces
 */
interface CRMService
{
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