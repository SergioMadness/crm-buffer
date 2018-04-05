<?php

return [
    'period'   => env('PERIOD', 10),
    'packSize' => env('PACK_SIZE', 10),
    'bitrix24' => [
        'url'           => env('BITRIX24_URL'),
        'client_id'     => env('BITRIX24_CLIENT_ID'),
        'client_secret' => env('BITRIX24_CLIENT_SECRET'),
        'access_token'  => env('BITRIX24_ACCESS_TOKEN'),
        'refresh_token' => env('BITRIX24_REFRESH_TOKEN'),
        'scope'         => explode(',', env('BITRIX24_SCOPE', 'crm')),
//        'period'        => env('BITRIX24_PERIOD', 10 * 60),
//        'packSize'      => env('BITRIX24_PACK_SIZE', 10),
    ],
];