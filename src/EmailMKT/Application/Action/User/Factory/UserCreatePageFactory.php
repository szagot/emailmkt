<?php

namespace EmailMKT\Application\Action\User\Factory;

use EmailMKT\Application\Action\User\UserCreatePageAction;
use EmailMKT\Application\Form\UserForm;
use EmailMKT\Domain\Persistence\UserRepositoryInterface;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class UserCreatePageFactory
{
    public function __invoke(ContainerInterface $container) : UserCreatePageAction
    {
        return new UserCreatePageAction(
            $container->get(UserRepositoryInterface::class),
            $container->get(TemplateRendererInterface::class),
            $container->get(RouterInterface::class),
            $container->get(UserForm::class)
        );
    }
}
