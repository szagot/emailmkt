<?php
use EmailMKT\Application\Middleware;
use Zend\Expressive\Container\ApplicationFactory;
use Zend\Expressive\Helper;

return [
    'dependencies'        => [
        'factories' => [
            Helper\ServerUrlMiddleware::class          => Helper\ServerUrlMiddlewareFactory::class,
            Helper\UrlHelperMiddleware::class          => Helper\UrlHelperMiddlewareFactory::class,
            Middleware\BootstrapMiddleware::class      => Middleware\BootstrapMiddlewareFactory::class,
            Middleware\TwigMiddleware::class           => Middleware\TwigMiddlewareFactory::class,
            Middleware\AuthenticationMiddleware::class => Middleware\AuthenticationMiddlewareFactory::class,
        ],
    ],
    // This can be used to seed pre- and/or post-routing middleware
    'middleware_pipeline' => [
        // An array of middleware to register. Each item is of the following
        // specification:
        //
        // [
        //  Required:
        //     'middleware' => 'Name or array of names of middleware services and/or callables',
        //  Optional:
        //     'path'     => '/path/to/match', // string; literal path prefix to match
        //                                     // middleware will not execute
        //                                     // if path does not match!
        //     'error'    => true, // boolean; true for error middleware
        //     'priority' => 1, // int; higher values == register early;
        //                      // lower/negative == register last;
        //                      // default is 1, if none is provided.
        // ],
        //
        // While the ApplicationFactory ignores the keys associated with
        // specifications, they can be used to allow merging related values
        // defined in multiple configuration files/locations. This file defines
        // some conventional keys for middleware to execute early, routing
        // middleware, and error middleware.

        // Este sempre é executado, coloque aqui os middleware de estrutura
        'always'  => [
            'middleware' => [
                // Add more middleware here that you want to execute on
                // every request:
                // - bootstrapping
                // - pre-conditions
                // - modifications to outgoing responses
                Helper\ServerUrlMiddleware::class,
                Middleware\BootstrapMiddleware::class,
                Middleware\TwigMiddleware::class,
            ],
            'priority'   => 10000,
        ],

        // Pipeline para proteção a ser executada depois dos middlewares 'always'
        'admin'   => [
            // Qual o path de base a ser protegido
            'path'       => '/admin',
            'middleware' => [
                Middleware\AuthenticationMiddleware::class
            ],
            'priority' => 9999,
        ],

        // É executado pra ter a estrutura de rotas montada
        'routing' => [
            'middleware' => [
                ApplicationFactory::ROUTING_MIDDLEWARE,
                Helper\UrlHelperMiddleware::class,
                // Add more middleware here that needs to introspect the routing
                // results; this might include:
                // - route-based authentication
                // - route-based validation
                // - etc.
                ApplicationFactory::DISPATCH_MIDDLEWARE,
            ],
            'priority'   => 1,
        ],

        // É executado para casos de erro
        'error' => [
            'middleware' => [
                // Add error middleware here.
            ],
            'error'      => true,
            'priority'   => -10000,
        ],
    ],
];
