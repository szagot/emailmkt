<?php

namespace EmailMKT\Application\Action\Tag\Factory;

use EmailMKT\Application\Action\Tag\TagListPageAction;
use EmailMKT\Domain\Persistence\TagRepositoryInterface;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class TagListPageFactory
{
    public function __invoke(ContainerInterface $container) : TagListPageAction
    {
        return new TagListPageAction(
            $container->get(TagRepositoryInterface::class),
            $container->get(TemplateRendererInterface::class)
        );
    }
}
