<?php

namespace EmailMKT\Application\Middleware;

use EmailMKT\Domain\Service\FlashMessageInterface;
use EmailMKT\Infrastructure\Bootstrap;
use Interop\Container\ContainerInterface;

class BootstrapMiddlewareFactory
{
    public function __invoke(ContainerInterface $container) : BootstrapMiddleware
    {
        $bootstrap = new Bootstrap();

        return new BootstrapMiddleware(
            $bootstrap,
            $container->get(FlashMessageInterface::class)
        );
    }
}
