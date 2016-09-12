<?php

namespace EmailMKT\Application\Middleware;

use EmailMKT\Application\Middleware\BootstrapMiddleware;
use EmailMKT\Infrastructure\Bootstrap;
use Interop\Container\ContainerInterface;

class BootstrapMiddlewareFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $bootstrap = new Bootstrap();

        return new BootstrapMiddleware($bootstrap);
    }
}