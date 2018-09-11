<?php namespace App\Subsystems\IntegrationHubCommon\Events;

use App\Subsystems\IntegrationHubDB\Models\Request;

/**
 * New request / event
 * @package App\Subsystems\IntegrationHubCommon\Events
 */
class NewRequest
{
    /**
     * @var Request
     */
    public $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
}