<?php
use EmailMKT\Application\Action;
use EmailMKT\Application\Action\Customer;

return [
    'dependencies' => [
        'invokables' => [
            Zend\Expressive\Router\RouterInterface::class => Zend\Expressive\Router\AuraRouter::class,
            Action\PingAction::class                      => Action\PingAction::class,
        ],

        'factories' => [
            Action\HomePageAction::class         => Action\HomePageFactory::class,
            Action\TestePageAction::class        => Action\TestePageFactory::class,

            // Customers
            Customer\CustomerListAction::class   => Customer\Factory\CustomerListFactory::class,
            Customer\CustomerCreateAction::class => Customer\Factory\CustomerCreateFactory::class,
        ],
    ],

    'routes' => [
        [
            'name'            => 'home',
            'path'            => '/',
            'middleware'      => Action\HomePageAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name'            => 'api.ping',
            'path'            => '/api/ping',
            'middleware'      => Action\PingAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name'            => 'teste',
            'path'            => '/teste',
            'middleware'      => Action\TestePageAction::class,
            'allowed_methods' => ['GET'],
        ],

        // Customers
        [
            'name'            => 'customers.list',
            'path'            => '/admin/customers',
            'middleware'      => Customer\CustomerListAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name'            => 'customer.create',
            'path'            => '/admin/customer/new',
            'middleware'      => Customer\CustomerCreateAction::class,
            'allowed_methods' => ['GET', 'POST'],
        ],
    ],
];
