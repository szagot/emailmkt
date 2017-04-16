<?php

namespace EmailMKT\Application\Action\Campaign\Factory;

use EmailMKT\Application\Action\Campaign\CampaignListPageAction;
use EmailMKT\Domain\Persistence\CampaignRepositoryInterface;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class CampaignListPageFactory
{
    public function __invoke(ContainerInterface $container) : CampaignListPageAction
    {
        return new CampaignListPageAction(
            $container->get(CampaignRepositoryInterface::class),
            $container->get(TemplateRendererInterface::class)
        );
    }
}
