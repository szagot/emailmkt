<?php

namespace EmailMKT\Application\Action\Tag\Factory;

use EmailMKT\Application\Action\Tag\TagUpdatePageAction;
use EmailMKT\Application\Form\TagForm;
use EmailMKT\Domain\Persistence\TagRepositoryInterface;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class TagUpdatePageFactory
{
    public function __invoke(ContainerInterface $container) : TagUpdatePageAction
    {
        return new TagUpdatePageAction(
            $container->get(TagRepositoryInterface::class),
            $container->get(TemplateRendererInterface::class),
            $container->get(RouterInterface::class),
            $container->get(TagForm::class)
        );
    }
}
