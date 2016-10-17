<?php
namespace EmailMKT\Infrastructure\Service;

use Interop\Container\ContainerInterface;
use Zend\Mvc\Controller\Plugin\FlashMessenger;

class FlashMessageFactory
{
    function __invoke(ContainerInterface $container) : FlashMessage
    {
        return new FlashMessage(
            new FlashMessenger()
        );
    }

}