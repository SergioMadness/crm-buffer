<?php

return [
    'namespace' => 'leads',
    'mapping'   => [
        'amount'      => 'price',
        'status'      => [
            'field'   => 'status',
            'mapping' => [
                'NEW'               => 1,
                'RE_LEAD'           => 1,
                'ASSIGNED'          => 2,
                'IN_PROCESS'        => 2,
                'UNABLE_TO_CONTACT' => 3,
                'SCRIPT_FAILS'      => 3,
                'UHB'               => 2,
                'POTENTIAL'         => 2,
                'DAI'               => 2,
                'DUPLICATE'         => 3,
                'JUNK'              => 3,
                'CONVERTED'         => 2,
            ],
        ],
        'url'         => 'url',
        'description' => 'description',
        'track_id'    => 'trackId',
        'promo_code'  => 'promoCode',
    ],
];