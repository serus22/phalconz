<?php

return [
    'zuser' => [
        'userCollection' => "PhalconZ\\ZUser\\Models\\ZUser"
    ],

    'route' => [
        '/auth/login' => [
            'module' => 'ZUser',
            'controller' => 'auth',
            'action' => 'login'
        ],
        '/auth/logout' => [
            'module' => 'ZUser',
            'controller' => 'auth',
            'action' => 'logout'
        ],
        '/auth/register' => [
            'module' => 'ZUser',
            'controller' => 'auth',
            'action' => 'register'
        ]
    ],
];