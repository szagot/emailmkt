<?php

namespace EmailMKT\Application\Action\Customer\Factory;

use EmailMKT\Application\Action\Customer\CustomerListPageAction;
use EmailMKT\Domain\Persistence\CustomerRepositoryInterface;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class CustomerListPageFactory
{
    public function __invoke(ContainerInterface $container) : CustomerListPageAction
    {
        return new CustomerListPageAction(
            $container->get(CustomerRepositoryInterface::class),
            $container->get(TemplateRendererInterface::class)
        );
    }
}
