<?php namespace App\Drivers\PartnerBox\Interfaces;

/**
 * Interface for service for integration with partner box
 * @package App\Drivers\PartnerBox\Interfaces
 */
interface PartnerBoxIntegrationService
{
    public const STATUS_APPROVED = 'A';

    public const STATUS_PENDING = 'P';

    public const STATUS_DECLINED = 'D';

    /**
     * Set visitor's ID
     *
     * @param mixed $visitorId
     *
     * @return PartnerBoxIntegrationService
     */
    public function setVisitorId($visitorId): self;

    /**
     * Track visitor
     *
     * @return bool
     */
    public function track(): bool;

    /**
     * Send event
     *
     * @param string     $eventName
     * @param string|int $productId
     * @param string|int $orderId
     * @param string     $data1
     * @param string     $data2
     *
     * @return bool
     */
    public function sendEvent(string $eventName, $productId, $orderId, $data1, $data2 = null): bool;

    /**
     * Set status to transaction
     *
     * @param int|string $orderId
     * @param string     $status
     *
     * @return bool
     */
    public function setTransactionStatus($orderId, string $status): bool;
}