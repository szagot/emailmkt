<?php

namespace EmailMKT\Application\Action\Customer\Factory;

use EmailMKT\Application\Action\Customer\CustomerUpdateAction;
use EmailMKT\Domain\Persistence\CustomerRepositoryInterface;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class CustomerUpdateFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new CustomerUpdateAction(
            $container->get(CustomerRepositoryInterface::class),
            $container->get(TemplateRendererInterface::class),
            $container->get(RouterInterface::class)
        );
    }
}
