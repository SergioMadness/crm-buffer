<?php

return [
    [
        'field'     => 'region',
        'operation' => '=',
        'value1'    => 'kaz',
        'success'   => [
            [
                'field'     => 'PRODUCT_ID',
                'operation' => '=',
                'value1'    => 261,
                'success'   => [
                    [
                        'field'     => 'is_fb',
                        'operation' => '=',
                        'value1'    => 1,
                        'result'    => [116, 51, 79, 85, 55, 31, 29, 27, 33],
                    ],
                    [
                        'field'     => 'is_fb',
                        'operation' => '!|=',
                        'value1'    => 1,
                        'result'    => [116, 51, 79, 85, 55, 31, 29, 27, 33],
                    ],
                ],
            ],
            [
                'field'     => 'PRODUCT_ID',
                'operation' => '=',
                'value1'    => 13,
                'success'   => [
                    [
                        'field'     => 'is_fb',
                        'operation' => '=',
                        'value1'    => 1,
                        'result'    => [35, 37, 41, 43, 45, 93, 91, 116, 65, 67],
                    ],
                    [
                        'field'     => 'is_fb',
                        'operation' => '!|=',
                        'value1'    => 1,
                        'result'    => [116, 51, 79, 85, 55, 31, 29, 27, 33],
                    ],
                ],
            ],
            [
                'field'     => 'PRODUCT_ID',
                'operation' => '!|in',
                'value1'    => [261, 13],
                'success'   => [
                    [
                        'field'     => 'is_fb',
                        'operation' => '=',
                        'value1'    => 1,
                        'result'    => [116, 65, 67],
                    ],
                    [
                        'field'     => 'is_fb',
                        'operation' => '!|=',
                        'value1'    => 1,
                        'result'    => [116, 65, 67],
                    ],
                ],
            ],
        ],
    ],
    [
        'field'     => 'region',
        'operation' => '=',
        'value1'    => 'ukr',
        'success'   => [
            [
                'field'     => 'PRODUCT_ID',
                'operation' => '=',
                'value1'    => 261,
                'success'   => [
                    [
                        'field'     => 'is_fb',
                        'operation' => '=',
                        'value1'    => 1,
                        'result'    => [21, 85, 59],
                    ],
                    [
                        'field'     => 'is_fb',
                        'operation' => '!|=',
                        'value1'    => 1,
                        'result'    => [21, 85, 59],
                    ],
                ],
            ],
            [
                'field'     => 'PRODUCT_ID',
                'operation' => '=',
                'value1'    => 13,
                'success'   => [
                    [
                        'field'     => 'is_fb',
                        'operation' => '=',
                        'value1'    => 1,
                        'result'    => [21, 85, 59, 51, 79, 77, 55, 31, 29, 27, 33],
                    ],
                    [
                        'field'     => 'is_fb',
                        'operation' => '!|=',
                        'value1'    => 1,
                        'result'    => [21, 85, 59],
                    ],
                ],
            ],
            [
                'field'     => 'PRODUCT_ID',
                'operation' => '!|in',
                'value1'    => [261, 13],
                'success'   => [
                    [
                        'field'     => 'is_fb',
                        'operation' => '=',
                        'value1'    => 1,
                        'result'    => [91, 93, 45, 43, 41, 37, 35],
                    ],
                    [
                        'field'     => 'is_fb',
                        'operation' => '!|=',
                        'value1'    => 1,
                        'result'    => [37, 41, 43, 45, 93, 91],
                    ],
                ],
            ],
        ],
    ],
    [
        'field'     => 'region',
        'operation' => '!|in',
        'value1'    => ['ukr', 'kaz'],
        'success'   => [
            [
                'field'     => 'PRODUCT_ID',
                'operation' => '=',
                'value1'    => 261,
                'success'   => [
                    [
                        'field'     => 'is_fb',
                        'operation' => '=',
                        'value1'    => 1,
                        'result'    => [51, 79, 77, 55, 31, 29, 27, 33, 35, 37, 41, 43, 45, 21, 85],
                    ],
                    [
                        'field'     => 'is_fb',
                        'operation' => '!|=',
                        'value1'    => 1,
                        'result'    => [51, 79, 77, 55, 31, 29, 27, 33, 35, 37, 41, 43, 45, 21, 85],
//'result'    => [51, 79, 77, 55, 31, 29],
                    ],
                ],
            ],
            [
                'field'     => 'PRODUCT_ID',
                'operation' => '=',
                'value1'    => 13,
                'success'   => [
                    [
                        'field'     => 'is_fb',
                        'operation' => '=',
                        'value1'    => 1,
                        'result'    => [85, 21, 45, 43, 41, 37, 35, 33, 27, 29, 31, 55, 77, 79, 51],
                    ],
                    [
                        'field'     => 'is_fb',
                        'operation' => '!|=',
                        'value1'    => 1,
                        'result'    => [51, 79, 77, 55, 31, 29, 27, 33, 35, 37, 41, 43, 45, 21, 85],
                    ],
                ],
            ],
            [
                'field'     => 'PRODUCT_ID',
                'operation' => '!|in',
                'value1'    => [261, 13],
                'success'   => [
                    [
                        'field'     => 'is_fb',
                        'operation' => '=',
                        'value1'    => 1,
                        'result'    => [91, 93, 45, 43, 41, 37, 35, 33, 27, 29, 31, 55, 77, 79],
                    ],
                    [
                        'field'     => 'is_fb',
                        'operation' => '!|=',
                        'value1'    => 1,
                        'result'    => [21, 85, 33, 35, 37, 41, 43, 45, 93, 91],
                    ],
                ],
            ],
        ],
    ],
];

