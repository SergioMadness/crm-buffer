<?php namespace App\Subsystems\IntegrationHubCommon\Interfaces\Services;

use App\Subsystems\IntegrationHubDB\Models\Request;

/**
 * Interface for request processor
 * @package App\Subsystems\IntegrationHubCommon\Interfaces\Services
 */
interface RequestProcessor
{
    /**
     * Process event
     *
     * @param Request $event
     *
     * @return RequestProcessor
     */
    public function event(Request $event): self;
}