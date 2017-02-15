<?php

namespace EmailMKT\Infrastructure\Persistence\Doctrine\Repository;

use Doctrine\ORM\EntityManager;
use EmailMKT\Domain\Entity\Campaign;
use Interop\Container\ContainerInterface;

class CampaignRepositoryFactory
{
    function __invoke(ContainerInterface $container) : CampaignRepository
    {
        /** @var EntityManager $entityManager */
        $entityManager = $container->get(EntityManager::class);

        return $entityManager->getRepository(Campaign::class);
    }

}