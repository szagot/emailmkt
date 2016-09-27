<?php
use EmailMKT\Application\Action;
use EmailMKT\Application\Action\Customer;

return [
    'dependencies' => [
        'invokables' => [
            Zend\Expressive\Router\RouterInterface::class => Zend\Expressive\Router\AuraRouter::class,
        ],

        'factories' => [
            Action\HomePageAction::class         => Action\HomePageFactory::class,

            // Login/Logout
            Action\LoginPageAction::class        => Action\LoginPageFactory::class,

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

        // Login/Logout
        [
            'name'            => 'auth.login',
            'path'            => '/admin/login',
            'middleware'      => Action\LoginPageAction::class,
            'allowed_methods' => ['GET', 'POST'],
        ],

        // Customers
        [
            'name'            => 'customers.list',
            'path'            => '/admin/customers{/order,type}',
            'middleware'      => Customer\CustomerListAction::class,
            'allowed_methods' => ['GET'],
            'options'         => [
                'tokens' => [
                    // Permite nulo ou uma das opções
                    'order' => '(id|name|email)?',
                    'type'  => '(asc|desc)?'
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
            'allowed_methods' => ['GET', 'PUT'],
            'options'         => [
                'tokens' => [
                    'id' => '\d+'
                ]
            ]
        ],
        [
            'name'            => 'customer.delete',
            'path'            => '/admin/customer/{id}/delete',
            'middleware'      => Customer\CustomerDeleteAction::class,
            'allowed_methods' => ['GET', 'DELETE'],
            'options'         => [
                'tokens' => [
                    'id' => '\d+'
                ]
            ]
        ],
    ],
];
