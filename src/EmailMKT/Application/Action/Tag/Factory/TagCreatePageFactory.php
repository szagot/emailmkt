<?php

namespace EmailMKT\Application\Action\Tag\Factory;

use EmailMKT\Application\Action\Tag\TagCreatePageAction;
use EmailMKT\Application\Form\TagForm;
use EmailMKT\Domain\Persistence\TagRepositoryInterface;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class TagCreatePageFactory
{
    public function __invoke(ContainerInterface $container) : TagCreatePageAction
    {
        return new TagCreatePageAction(
            $container->get(TagRepositoryInterface::class),
            $container->get(TemplateRendererInterface::class),
            $container->get(RouterInterface::class),
            $container->get(TagForm::class)
        );
    }
}
