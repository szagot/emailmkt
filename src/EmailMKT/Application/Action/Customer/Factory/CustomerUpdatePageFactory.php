<?php

namespace EmailMKT\Application\Action\Customer\Factory;

use EmailMKT\Application\Action\Customer\CustomerUpdatePageAction;
use EmailMKT\Application\Form\CustomerForm;
use EmailMKT\Domain\Persistence\CustomerRepositoryInterface;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class CustomerUpdatePageFactory
{
    public function __invoke(ContainerInterface $container) : CustomerUpdatePageAction
    {
        return new CustomerUpdatePageAction(
            $container->get(CustomerRepositoryInterface::class),
            $container->get(TemplateRendererInterface::class),
            $container->get(RouterInterface::class),
            $container->get(CustomerForm::class)
        );
    }
}
