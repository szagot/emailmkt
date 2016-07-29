<?php

namespace EmailMKT\Action;

use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class TestePageFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $template = ($container->has(TemplateRendererInterface::class))
            ? $container->get(TemplateRendererInterface::class)
            : null;

        $entity = ($container->has(EntityManager::class))
            ? $container->get(EntityManager::class)
            : null;

        return new TestePageAction($entity, $template);
    }
}
