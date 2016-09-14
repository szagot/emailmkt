<?php

namespace EmailMKT\Application\Action\Customer\Factory;

use EmailMKT\Application\Action\Customer\CustomerDeleteAction;
use EmailMKT\Domain\Persistence\CustomerRepositoryInterface;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class CustomerDeleteFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new CustomerDeleteAction(
            $container->get(CustomerRepositoryInterface::class),
            $container->get(TemplateRendererInterface::class),
            $container->get(RouterInterface::class)
        );
    }
}
