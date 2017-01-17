<?php

namespace EmailMKT\Application\Action\User\Factory;

use EmailMKT\Application\Action\User\UserListPageAction;
use EmailMKT\Domain\Persistence\UserRepositoryInterface;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class UserListPageFactory
{
    public function __invoke(ContainerInterface $container) : UserListPageAction
    {
        return new UserListPageAction(
            $container->get(UserRepositoryInterface::class),
            $container->get(TemplateRendererInterface::class)
        );
    }
}
