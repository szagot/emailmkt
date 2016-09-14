<?php
use EmailMKT\Domain\Persistence\CustomerRepositoryInterface;
use EmailMKT\Domain\Service\FlashMessageInterface;

use EmailMKT\Infrastructure\Persistence\Doctrine\Repository\CustomerRepositoryFactory;
use EmailMKT\Infrastructure\Service\FlashMessageFactory;

use Zend\Expressive\Application;
use Zend\Expressive\Container\ApplicationFactory;
use Zend\Expressive\Helper;

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

            // Controle de seção e flash messages
            Aura\Session\Session::class        => DaMess\Factory\AuraSessionFactory::class,
            FlashMessageInterface::class       => FlashMessageFactory::class,

            // Dependencias das entidades
            CustomerRepositoryInterface::class => CustomerRepositoryFactory::class,
        ],
        'aliases'    => [
            'configuration' => 'config', //Doctrine needs a service called Configuration
        ],
    ],
];
