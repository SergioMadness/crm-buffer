<?php namespace App\Subsystems\IntegrationHub\Events;

use App\Subsystems\IntegrationHub\Constants\Request;

/**
 * New request / event
 * @package App\Subsystems\IntegrationHub\Events
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