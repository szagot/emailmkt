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
    CustomerListPageAction, CustomerCreatePageAction, CustomerDeletePageAction, CustomerUpdatePageAction
};
use EmailMKT\Application\Action\Customer\Factory\{
    CustomerListPageFactory, CustomerCreatePageFactory, CustomerDeletePageFactory, CustomerUpdatePageFactory
};
use EmailMKT\Application\Action\Tag\{
    TagListPageAction, TagCreatePageAction, TagDeletePageAction, TagUpdatePageAction
};
use EmailMKT\Application\Action\Tag\Factory\{
    TagListPageFactory, TagCreatePageFactory, TagDeletePageFactory, TagUpdatePageFactory
};
use EmailMKT\Application\Action\User\{
    UserListPageAction, UserCreatePageAction, UserDeletePageAction, UserUpdatePageAction
};
use EmailMKT\Application\Action\User\Factory\{
    UserListPageFactory, UserCreatePageFactory, UserDeletePageFactory, UserUpdatePageFactory
};
use EmailMKT\Application\Action\Campaign\{
    CampaignListPageAction, CampaignCreatePageAction, CampaignDeletePageAction, CampaignUpdatePageAction
};
use EmailMKT\Application\Action\Campaign\Factory\{
    CampaignListPageFactory, CampaignCreatePageFactory, CampaignDeletePageFactory, CampaignUpdatePageFactory
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

            // Tags
            TagListPageAction::class        => TagListPageFactory::class,
            TagCreatePageAction::class      => TagCreatePageFactory::class,
            TagUpdatePageAction::class      => TagUpdatePageFactory::class,
            TagDeletePageAction::class      => TagDeletePageFactory::class,

            // Customers
            UserListPageAction::class       => UserListPageFactory::class,
            UserCreatePageAction::class     => UserCreatePageFactory::class,
            UserUpdatePageAction::class     => UserUpdatePageFactory::class,
            UserDeletePageAction::class     => UserDeletePageFactory::class,

            // Campaign
            CampaignListPageAction::class   => CampaignListPageFactory::class,
            CampaignCreatePageAction::class => CampaignCreatePageFactory::class,
            CampaignUpdatePageAction::class => CampaignUpdatePageFactory::class,
            CampaignDeletePageAction::class => CampaignDeletePageFactory::class,
        ],
    ],

    'routes' => [
        [
            'name'            => 'home',
            'path'            => '/',
            'middleware'      => HomePageAction::class,
            'allowed_methods' => ['GET'],
        ], # /
        [
            'name'            => 'home.list',
            'path'            => '/admin',
            'middleware'      => CustomerListPageAction::class,
            'allowed_methods' => ['GET'],
        ], # /admin/

        // Login/Logout
        [
            'name'            => 'auth.login',
            'path'            => '/admin/login',
            'middleware'      => LoginPageAction::class,
            'allowed_methods' => ['GET', 'POST'],
        ], # Login
        [
            'name'            => 'auth.logout',
            'path'            => '/admin/logout',
            'middleware'      => LogoutAction::class,
            'allowed_methods' => ['GET'],
        ], # Logout

        // Customers
        [
            'name'            => 'customer.list',
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
        ], # List
        [
            'name'            => 'customer.create',
            'path'            => '/admin/customer/new',
            'middleware'      => CustomerCreatePageAction::class,
            'allowed_methods' => ['GET', 'POST'],
        ], # Create
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
        ], # Update
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
        ], # Delete

        // Tags
        [
            'name'            => 'tag.list',
            'path'            => '/admin/tags{/order,type}',
            'middleware'      => TagListPageAction::class,
            'allowed_methods' => ['GET'],
            'options'         => [
                'tokens' => [
                    // Permite nulo ou uma das opções
                    'order' => '(id|name)?',
                    'type'  => '(asc|desc)?'
                ]
            ]
        ], # List
        [
            'name'            => 'tag.create',
            'path'            => '/admin/tag/new',
            'middleware'      => TagCreatePageAction::class,
            'allowed_methods' => ['GET', 'POST'],
        ], # Create
        [
            'name'            => 'tag.update',
            'path'            => '/admin/tag/{id}',
            'middleware'      => TagUpdatePageAction::class,
            'allowed_methods' => ['GET', 'PUT'],
            'options'         => [
                'tokens' => [
                    'id' => '\d+'
                ]
            ]
        ], # Update
        [
            'name'            => 'tag.delete',
            'path'            => '/admin/tag/{id}/delete',
            'middleware'      => TagDeletePageAction::class,
            'allowed_methods' => ['GET', 'DELETE'],
            'options'         => [
                'tokens' => [
                    'id' => '\d+'
                ]
            ]
        ], # delete

        // User
        [
            'name'            => 'user.list',
            'path'            => '/admin/users{/order,type}',
            'middleware'      => UserListPageAction::class,
            'allowed_methods' => ['GET'],
            'options'         => [
                'tokens' => [
                    // Permite nulo ou uma das opções
                    'order' => '(id|name|email)?',
                    'type'  => '(asc|desc)?'
                ]
            ]
        ], # List
        [
            'name'            => 'user.create',
            'path'            => '/admin/user/new',
            'middleware'      => UserCreatePageAction::class,
            'allowed_methods' => ['GET', 'POST'],
        ], # Create
        [
            'name'            => 'user.update',
            'path'            => '/admin/user/{id}',
            'middleware'      => UserUpdatePageAction::class,
            'allowed_methods' => ['GET', 'PUT'],
            'options'         => [
                'tokens' => [
                    'id' => '\d+'
                ]
            ]
        ], # Update
        [
            'name'            => 'user.delete',
            'path'            => '/admin/user/{id}/delete',
            'middleware'      => UserDeletePageAction::class,
            'allowed_methods' => ['GET', 'DELETE'],
            'options'         => [
                'tokens' => [
                    'id' => '\d+'
                ]
            ]
        ], # Delete

        // Campaign
        [
            'name'            => 'campaign.list',
            'path'            => '/admin/campaign{/order,type}',
            'middleware'      => CampaignListPageAction::class,
            'allowed_methods' => ['GET'],
            'options'         => [
                'tokens' => [
                    // Permite nulo ou uma das opções
                    'order' => '(id|name|email)?',
                    'type'  => '(asc|desc)?'
                ]
            ]
        ], # List
        [
            'name'            => 'campaign.create',
            'path'            => '/admin/campaign/new',
            'middleware'      => CampaignCreatePageAction::class,
            'allowed_methods' => ['GET', 'POST'],
        ], # Create
        [
            'name'            => 'campaign.update',
            'path'            => '/admin/campaign/{id}',
            'middleware'      => CampaignUpdatePageAction::class,
            'allowed_methods' => ['GET', 'PUT'],
            'options'         => [
                'tokens' => [
                    'id' => '\d+'
                ]
            ]
        ], # Update
        [
            'name'            => 'campaign.delete',
            'path'            => '/admin/campaign/{id}/delete',
            'middleware'      => CampaignDeletePageAction::class,
            'allowed_methods' => ['GET', 'DELETE'],
            'options'         => [
                'tokens' => [
                    'id' => '\d+'
                ]
            ]
        ], # Delete

    ],
];
