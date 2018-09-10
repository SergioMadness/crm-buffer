<?php namespace App\Subsystems\IntegrationHubCommon\Constants;

/**
 * Constants used in http requests and responses
 * @package App\Subsystems\IntegrationHubCommon\Constants
 */
interface Request
{
    public const TOKEN_HEADER_NAME = 'x-pw-token';

    public const REFRESH_TOKEN_HEADER_NAME = 'x-pw-refresh-token';
}