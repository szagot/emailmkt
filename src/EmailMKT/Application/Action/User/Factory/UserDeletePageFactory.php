<?php

namespace EmailMKT\Application\Action\User\Factory;

use EmailMKT\Application\Action\User\UserDeletePageAction;
use EmailMKT\Application\Form\UserForm;
use EmailMKT\Domain\Persistence\UserRepositoryInterface;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class UserDeletePageFactory
{
    public function __invoke(ContainerInterface $container) : UserDeletePageAction
    {
        return new UserDeletePageAction(
            $container->get(UserRepositoryInterface::class),
            $container->get(TemplateRendererInterface::class),
            $container->get(RouterInterface::class),
            $container->get(UserForm::class)
        );
    }
}
