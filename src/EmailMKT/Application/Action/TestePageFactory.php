<?php

namespace EmailMKT\Application\Action;

use Doctrine\ORM\EntityManager;
use EmailMKT\Domain\Persistence\CustomerRepositoryInterface;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class TestePageFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $template = ($container->has(TemplateRendererInterface::class))
            ? $container->get(TemplateRendererInterface::class)
            : null;

        // Testando repositório de contato
        return new TestePageAction($container->get(CustomerRepositoryInterface::class), $template);
    }
}
