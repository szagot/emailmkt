<?php
use EmailMKT\Domain\Persistence\CustomerRepositoryInterface;
use EmailMKT\Domain\Service\AuthInterface;
use EmailMKT\Domain\Service\FlashMessageInterface;

use EmailMKT\Infrastructure\Persistence\Doctrine\Repository\CustomerRepositoryFactory;
use EmailMKT\Infrastructure\Service\FlashMessageFactory;
use EmailMKT\Infrastructure\Service;

use Zend\Expressive\Application;
use Zend\Expressive\Container\ApplicationFactory;
use Zend\Expressive\Helper;
use Zend\Authentication\AuthenticationService;

return [
    // Provides application-wide services.
    // We recommend using fully-qualified class names whenever possible as
    // service names.
    'dependencies' => [
        // Use 'invokables' for constructor-less services, or services that do
        // not require arguments to the constructor. Map a service name to the
        // class name.
        'invokables' => [
            // Fully\Qualified\InterfaceName::class => Fully\Qualified\ClassName::class,
            Helper\ServerUrlHelper::class => Helper\ServerUrlHelper::class,
        ],
        // Use 'factories' for services provided by callbacks/factory classes.
        'factories'  => [
            Application::class                 => ApplicationFactory::class,
            Helper\UrlHelper::class            => Helper\UrlHelperFactory::class,

            // Controle de flash messages
            FlashMessageInterface::class       => FlashMessageFactory::class,

            // Fixtures: https://github.com/codeedu/zendexpr-doctrine-fixture
            'doctrine:fixtures_cmd:load'       => CodeEdu\FixtureFactory::class,

            // Authenticate
            AuthInterface::class               => Service\AuthServiceFactory::class,

            // Dependencias das entidades
            CustomerRepositoryInterface::class => CustomerRepositoryFactory::class,
        ],
        'aliases'    => [
            'Configuration'              => 'config',
            'Config'                     => 'config',
            // Serviço de autenticação
            AuthenticationService::class => 'doctrine.authenticationservice.orm_default',
        ],
    ],
];
