<?php
use EmailMKT\Application\Action;

return [
    'dependencies' => [
        'invokables' => [
            Action\PingAction::class => Action\PingAction::class,
        ],

        'factories' => [
        ],
    ],

    'routes' => [
        [
            'name'            => 'api.ping',
            'path'            => '/api/ping',
            'middleware'      => Action\PingAction::class,
            'allowed_methods' => ['GET'],
        ],
    ],
];
