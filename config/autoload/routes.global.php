<?php
use EmailMKT\Application\Action\{
    HomePageAction,
    HomePageFactory,
    LoginPageAction,
    LoginPageFactory,
    LogoutAction,
    LogoutFactory
};
use EmailMKT\Application\Action\Customer\{
    CustomerListPageAction,
    CustomerCreatePageAction,
    CustomerDeletePageAction,
    CustomerUpdatePageAction
};
use EmailMKT\Application\Action\Customer\Factory\{
    CustomerListPageFactory,
    CustomerCreatePageFactory,
    CustomerDeletePageFactory,
    CustomerUpdatePageFactory
};

return [
    'dependencies' => [
        'invokables' => [
            Zend\Expressive\Router\RouterInterface::class => Zend\Expressive\Router\AuraRouter::class,
        ],

        'factories' => [
            HomePageAction::class           => HomePageFactory::class,

            // Login/Logout
            LoginPageAction::class          => LoginPageFactory::class,
            LogoutAction::class             => LogoutFactory::class,

            // Customers
            CustomerListPageAction::class   => CustomerListPageFactory::class,
            CustomerCreatePageAction::class => CustomerCreatePageFactory::class,
            CustomerUpdatePageAction::class => CustomerUpdatePageFactory::class,
            CustomerDeletePageAction::class => CustomerDeletePageFactory::class,
        ],
    ],

    'routes' => [
        [
            'name'            => 'home',
            'path'            => '/',
            'middleware'      => HomePageAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name'            => 'home.list',
            'path'            => '/admin',
            'middleware'      => CustomerListPageAction::class,
            'allowed_methods' => ['GET'],
        ],

        // Login/Logout
        [
            'name'            => 'auth.login',
            'path'            => '/admin/login',
            'middleware'      => LoginPageAction::class,
            'allowed_methods' => ['GET', 'POST'],
        ],
        [
            'name'            => 'auth.logout',
            'path'            => '/admin/logout',
            'middleware'      => LogoutAction::class,
            'allowed_methods' => ['GET'],
        ],

        // Customers
        [
            'name'            => 'customers.list',
            'path'            => '/admin/customers{/order,type}',
            'middleware'      => CustomerListPageAction::class,
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
            'middleware'      => CustomerCreatePageAction::class,
            'allowed_methods' => ['GET', 'POST'],
        ],
        [
            'name'            => 'customer.update',
            'path'            => '/admin/customer/{id}',
            'middleware'      => CustomerUpdatePageAction::class,
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
            'middleware'      => CustomerDeletePageAction::class,
            'allowed_methods' => ['GET', 'DELETE'],
            'options'         => [
                'tokens' => [
                    'id' => '\d+'
                ]
            ]
        ],
    ],
];
