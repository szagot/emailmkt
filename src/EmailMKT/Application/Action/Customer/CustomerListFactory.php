<?php

namespace EmailMKT\Application\Action\Customer;

use EmailMKT\Domain\Persistence\CustomerRepositoryInterface;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class CustomerListFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new CustomerListAction(
            $container->get(CustomerRepositoryInterface::class),
            $container->get(TemplateRendererInterface::class)
        );
    }
}
