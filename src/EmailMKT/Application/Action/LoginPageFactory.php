<?php

namespace EmailMKT\Application\Action;

use EmailMKT\Application\Form\LoginForm;
use EmailMKT\Infrastructure\Service\AuthService;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class LoginPageFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new LoginPageAction(
            $container->get(RouterInterface::class),
            $container->get(TemplateRendererInterface::class),
            $container->get(LoginForm::class),
            $container->get(AuthService::class)
        );
    }
}
