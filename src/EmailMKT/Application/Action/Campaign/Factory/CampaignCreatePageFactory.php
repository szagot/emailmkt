<?php

namespace EmailMKT\Application\Action\Campaign\Factory;

use EmailMKT\Application\Action\Campaign\CampaignCreatePageAction;
use EmailMKT\Application\Form\CampaignForm;
use EmailMKT\Domain\Persistence\CampaignRepositoryInterface;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class CampaignCreatePageFactory
{
    public function __invoke(ContainerInterface $container) : CampaignCreatePageAction
    {
        return new CampaignCreatePageAction(
            $container->get(CampaignRepositoryInterface::class),
            $container->get(TemplateRendererInterface::class),
            $container->get(RouterInterface::class),
            $container->get(CampaignForm::class)
        );
    }
}
