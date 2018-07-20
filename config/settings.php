<?php

return [
    'table_name' => 'settings',

    'view' => 'bootstrap-4',

    'restrict' => [
        'database.*'
    ],

    'middleware' => ['web', 'auth'],
];
