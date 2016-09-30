<?php

namespace EmailMKT\Application\Action;

use EmailMKT\Infrastructure\Service\AuthService;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;

class LogoutFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new LogoutAction(
            $container->get(RouterInterface::class),
            $container->get(AuthService::class)
        );
    }
}
