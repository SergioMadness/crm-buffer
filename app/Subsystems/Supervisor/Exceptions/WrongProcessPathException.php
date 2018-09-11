<?php namespace App\Subsystems\Supervisor\Exceptions;

use Throwable;

/**
 * Exception thrown when system can't find next step
 * @package App\Subsystems\IntegrationHubCommon\Exceptions
 */
class WrongProcessPathException extends \Exception
{
    public function __construct(string $message = 'wrong path / can\' find next step', int $code = 1001, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}