<?php
use EmailMKT\Application\Action;
use EmailMKT\Application\Action\Customer;

return [
    'dependencies' => [
        'invokables' => [
            Zend\Expressive\Router\RouterInterface::class => Zend\Expressive\Router\AuraRouter::class,
        ],

        'factories' => [
            Action\HomePageAction::class             => Action\HomePageFactory::class,

            // Login/Logout
            Action\LoginPageAction::class            => Action\LoginPageFactory::class,
            Action\LogoutAction::class               => Action\LogoutFactory::class,

            // Customers
            Customer\CustomerListPageAction::class   => Customer\Factory\CustomerListPageFactory::class,
            Customer\CustomerCreatePageAction::class => Customer\Factory\CustomerCreatePageFactory::class,
            Customer\CustomerUpdatePageAction::class => Customer\Factory\CustomerUpdatePageFactory::class,
            Customer\CustomerDeletePageAction::class => Customer\Factory\CustomerDeletePageFactory::class,
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
        [
            'name'            => 'auth.logout',
            'path'            => '/admin/logout',
            'middleware'      => Action\LogoutAction::class,
            'allowed_methods' => ['GET'],
        ],

        // Customers
        [
            'name'            => 'customers.list',
            'path'            => '/admin/customers{/order,type}',
            'middleware'      => Customer\CustomerListPageAction::class,
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
            'middleware'      => Customer\CustomerCreatePageAction::class,
            'allowed_methods' => ['GET', 'POST'],
        ],
        [
            'name'            => 'customer.update',
            'path'            => '/admin/customer/{id}',
            'middleware'      => Customer\CustomerUpdatePageAction::class,
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
            'middleware'      => Customer\CustomerDeletePageAction::class,
            'allowed_methods' => ['GET', 'DELETE'],
            'options'         => [
                'tokens' => [
                    'id' => '\d+'
                ]
            ]
        ],
    ],
];
