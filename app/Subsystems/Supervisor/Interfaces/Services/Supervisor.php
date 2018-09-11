<?php namespace App\Subsystems\Supervisor\Interfaces\Services;

use App\Subsystems\IntegrationHubDB\Models\Request;
use App\Subsystems\IntegrationHubDB\Interfaces\Models\ProcessOptions;

/**
 * Interface for event supervisor
 * @package App\Subsystems\IntegrationHubCommon\Interfaces\Services
 */
interface Supervisor
{
    /**
     * Add/update event
     *
     * @param Request $request
     *
     * @return ProcessOptions
     */
    public function nextProcess(Request $request): ?ProcessOptions;
}