<?php
namespace EmailMKT\Infrastructure\Service;

use Aura\Session\Segment;
use Interop\Container\ContainerInterface;

class FlashMessageFactory
{
    function __invoke(ContainerInterface $container)
    {
        return new FlashMessage(
            $container->get(Segment::class)
        );
    }

}