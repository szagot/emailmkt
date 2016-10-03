<?php

namespace EmailMKT\Application\Action;

use EmailMKT\Domain\Service\AuthInterface;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;

class LogoutFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new LogoutAction(
            $container->get(RouterInterface::class),
            $container->get(AuthInterface::class)
        );
    }
}
