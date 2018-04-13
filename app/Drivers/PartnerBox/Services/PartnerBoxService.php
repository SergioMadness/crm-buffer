<?php namespace App\Drivers\PartnerBox\Services;

use App\Drivers\PartnerBox\Interfaces\PartnerBoxService as IPartnerBoxService;

/**
 * Service to work with Post Affiliate Network (http://partnerbox.org/)
 * @package App\Drivers\PartnerBox\Services
 */
class PartnerBoxService implements IPartnerBoxService
{

    /**
     * Send lead to CRM
     *
     * @param array $data
     *
     * @return bool
     */
    public function sendLead(array $data): bool
    {
        // TODO: Implement sendLead() method.
    }

    /**
     * Send contact to CRM
     *
     * @param array $data
     *
     * @return bool
     */
    public function sendContact(array $data): bool
    {
        // TODO: Implement sendContact() method.
    }

    /**
     * Get response messages/errors
     *
     * @return array
     */
    public function getMessages(): array
    {
        // TODO: Implement getMessages() method.
    }

    /**
     * Check last request was successful
     *
     * @return bool
     */
    public function isSuccess(): bool
    {
        // TODO: Implement isSuccess() method.
    }
}