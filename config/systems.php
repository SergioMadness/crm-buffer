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
    'pap'      => [
        'account_id' => env('PAP_ACCOUNT_ID'),
        'login'      => env('PAP_LOGIN'),
        'password'   => env('PAP_PASSWORD'),
        'sale_url'   => env('PAP_SALE_URL'),
        'server_url' => env('PAP_SERVER_URL'),

        'lead_event_name'          => env('PAP_LEAD_EVENT_NAME'),
        'lead_event_product_id'    => env('PAP_LEAD_EVENT_PRODUCT_ID'),
        'contact_event_name'       => env('PAP_CONTACT_EVENT_NAME'),
        'contact_event_product_id' => env('PAP_CONTACT_EVENT_PRODUCT_ID'),
//        'period'        => env('PAP_PERIOD', 10 * 60),
//        'packSize'      => env('PAP_PACK_SIZE', 10),
    ],
];