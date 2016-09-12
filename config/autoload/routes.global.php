<?php

return [
    'dependencies' => [
        'invokables' => [
            Zend\Expressive\Router\RouterInterface::class => Zend\Expressive\Router\AuraRouter::class,
            EmailMKT\Application\Action\PingAction::class => EmailMKT\Application\Action\PingAction::class,
        ],
        'factories' => [
            EmailMKT\Application\Action\HomePageAction::class  => EmailMKT\Application\Action\HomePageFactory::class,
            EmailMKT\Application\Action\TestePageAction::class => EmailMKT\Application\Action\TestePageFactory::class,
        ],
    ],

    'routes' => [
        [
            'name' => 'home',
            'path' => '/',
            'middleware' => EmailMKT\Application\Action\HomePageAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'api.ping',
            'path' => '/api/ping',
            'middleware' => EmailMKT\Application\Action\PingAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'teste',
            'path' => '/teste',
            'middleware' => EmailMKT\Application\Action\TestePageAction::class,
            'allowed_methods' => ['GET'],
        ],
    ],
];
