<?php namespace App\Drivers\Bitrix24\Interfaces;

use App\Interfaces\Services\CRMService;

interface Bitrix24Service extends CRMService
{
    public const EVENT_ON_LEAD_ASSIGN = 'on:assign:lead';
}