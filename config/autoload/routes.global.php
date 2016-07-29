<?php

return [
    'dependencies' => [
        'invokables' => [
            Zend\Expressive\Router\RouterInterface::class => Zend\Expressive\Router\AuraRouter::class,
            EmailMKT\Action\PingAction::class => EmailMKT\Action\PingAction::class,
        ],
        'factories' => [
            EmailMKT\Action\HomePageAction::class => EmailMKT\Action\HomePageFactory::class,
            EmailMKT\Action\TestePageAction::class => EmailMKT\Action\TestePageFactory::class,
        ],
    ],

    'routes' => [
        [
            'name' => 'home',
            'path' => '/',
            'middleware' => EmailMKT\Action\HomePageAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'api.ping',
            'path' => '/api/ping',
            'middleware' => EmailMKT\Action\PingAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'teste',
            'path' => '/teste',
            'middleware' => EmailMKT\Action\TestePageAction::class,
            'allowed_methods' => ['GET'],
        ],
    ],
];
