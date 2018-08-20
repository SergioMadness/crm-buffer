<?php namespace App\Drivers\Bitrix24\Interfaces;

use App\Subsystems\CRMBuffer\Interfaces\Services\CRMService;

interface Bitrix24Service extends CRMService
{
    /**
     * Event name fired before lead sending
     */
    public const EVENT_BEFORE_SEND_LEAD = 'before:send:lead';

    /**
     * Event name fired before contact sending
     */
    public const EVENT_BEFORE_SEND_CONTACT = 'before:send:contact';

    /**
     * Event name fired when lead was sent
     */
    public const EVENT_AFTER_SEND_LEAD = 'after:send:lead';

    /**
     * Event name fired when contact was sent
     */
    public const EVENT_AFTER_SEND_CONTACT = 'after:send:contact';
}