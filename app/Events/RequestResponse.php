<?php namespace App\Events;

use App\Models\Request;

/**
 * Response to request
 * @package App\Events
 */
class RequestResponse extends Event
{
    public $id;

    public $status;

    public $response;

    public $system;

    public function __construct(string $id, $response, string $system, string $status = Request::STATUS_SUCCESS)
    {
        $this->id = $id;
        $this->response = $response;
        $this->status = $status;
        $this->system = $system;
    }
}