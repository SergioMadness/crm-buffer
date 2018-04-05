<?php namespace App\Events;

/**
 * Response to request
 * @package App\Events
 */
class RequestResponse extends Event
{
    public $id;

    public $success;

    public $response;

    public $system;

    public function __construct(string $id, $response, string $system, bool $success = true)
    {
        $this->id = $id;
        $this->response = $response;
        $this->success = $success;
        $this->system = $system;
    }
}