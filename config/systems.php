<?php

return [
    'period'   => env('PERIOD', 10),
    'packSize' => env('PACK_SIZE', 10),
    'bitrix24' => [
        'filter' => include __DIR__ . '/filter.php',
    ],
];