<?php namespace App\Constants;

/**
 * Constants used in http requests and responses
 * @package App\Constants
 */
interface Request
{
    public const TOKEN_HEADER_NAME = 'x-cbs-token';

    public const REFRESH_TOKEN_HEADER_NAME = 'x-cbs-refresh-token';
}