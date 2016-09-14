<?php
namespace EmailMKT\Infrastructure\Service;

use Aura\Session\Session;
use Interop\Container\ContainerInterface;

class FlashMessageFactory
{
    function __invoke(ContainerInterface $container)
    {
        return new FlashMessage(
            $container->get(Session::class)
        );
    }

}