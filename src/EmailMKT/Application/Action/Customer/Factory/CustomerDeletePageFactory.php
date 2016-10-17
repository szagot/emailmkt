<?php

namespace EmailMKT\Application\Action\Customer\Factory;

use EmailMKT\Application\Action\Customer\CustomerDeletePageAction;
use EmailMKT\Application\Form\CustomerForm;
use EmailMKT\Domain\Persistence\CustomerRepositoryInterface;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class CustomerDeletePageFactory
{
    public function __invoke(ContainerInterface $container) : CustomerDeletePageAction
    {
        return new CustomerDeletePageAction(
            $container->get(CustomerRepositoryInterface::class),
            $container->get(TemplateRendererInterface::class),
            $container->get(RouterInterface::class),
            $container->get(CustomerForm::class)
        );
    }
}
