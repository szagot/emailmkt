<?php

namespace EmailMKT\Application\Middleware;

use EmailMKT\Application\Middleware\BootstrapMiddleware;
use EmailMKT\Domain\Service\AuthInterface;
use EmailMKT\Domain\Service\FlashMessageInterface;
use EmailMKT\Infrastructure\Bootstrap;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;

class AuthenticationMiddlewareFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new AuthenticationMiddleware(
            $container->get(RouterInterface::class),
            $container->get(AuthInterface::class)
        );
    }
}
