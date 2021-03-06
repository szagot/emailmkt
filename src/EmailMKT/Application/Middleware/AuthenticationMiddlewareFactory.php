<?php

namespace EmailMKT\Application\Middleware;

use EmailMKT\Domain\Service\AuthInterface;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;

class AuthenticationMiddlewareFactory
{
    public function __invoke(ContainerInterface $container) : AuthenticationMiddleware
    {
        return new AuthenticationMiddleware(
            $container->get(RouterInterface::class),
            $container->get(AuthInterface::class)
        );
    }
}
