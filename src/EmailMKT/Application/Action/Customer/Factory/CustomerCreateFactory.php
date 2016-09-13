<?php

namespace EmailMKT\Application\Action\Customer\Factory;

use EmailMKT\Application\Action\Customer\CustomerCreateAction;
use EmailMKT\Domain\Persistence\CustomerRepositoryInterface;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class CustomerCreateFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new CustomerCreateAction(
            $container->get(CustomerRepositoryInterface::class),
            $container->get(TemplateRendererInterface::class)
        );
    }
}
