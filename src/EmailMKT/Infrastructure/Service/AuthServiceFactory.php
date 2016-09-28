<?php
namespace EmailMKT\Infrastructure\Service;

use Interop\Container\ContainerInterface;
use Zend\Authentication\AuthenticationService;

class AuthServiceFactory
{
    function __invoke(ContainerInterface $container)
    {
        return new AuthService(
            $container->get(AuthenticationService::class)
        );
    }
}