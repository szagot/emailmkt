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
            Customer\CustomerUpdateAction::class => Customer\Factory\CustomerUpdateFactory::class,
            Customer\CustomerDeleteAction::class => Customer\Factory\CustomerDeleteFactory::class,
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
            'path'            => '/admin/customers{/order,type}',
            'middleware'      => Customer\CustomerListAction::class,
            'allowed_methods' => ['GET'],
            'options'         => [
                'tokens' => [
                    'order' => '(id|name|email)',
                    'type'  => '(asc|desc)'
                ]
            ]
        ],
        [
            'name'            => 'customer.create',
            'path'            => '/admin/customer/new',
            'middleware'      => Customer\CustomerCreateAction::class,
            'allowed_methods' => ['GET', 'POST'],
        ],
        [
            'name'            => 'customer.update',
            'path'            => '/admin/customer/{id}',
            'middleware'      => Customer\CustomerUpdateAction::class,
            'allowed_methods' => ['GET', 'POST'],
            'options'         => [
                'tokens' => [
                    // O parametro id apenas aceita numeros maiores que 0
                    'id' => '[1-9][0-9]*'
                ]
            ]
        ],
        [
            'name'            => 'customer.delete',
            'path'            => '/admin/customer/{id}/delete',
            'middleware'      => Customer\CustomerDeleteAction::class,
            'allowed_methods' => ['GET', 'POST'],
            'options'         => [
                'tokens' => [
                    // O parametro id apenas aceita numeros maiores que 0
                    'id' => '[1-9][0-9]*'
                ]
            ]
        ],
    ],
];
