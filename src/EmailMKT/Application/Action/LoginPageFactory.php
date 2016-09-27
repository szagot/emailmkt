<?php

namespace EmailMKT\Application\Action;

use EmailMKT\Domain\Persistence\CustomerRepositoryInterface;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class LoginPageFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new LoginPageAction(
            $container->get(CustomerRepositoryInterface::class),
            $container->get(TemplateRendererInterface::class)
        );
    }
}
