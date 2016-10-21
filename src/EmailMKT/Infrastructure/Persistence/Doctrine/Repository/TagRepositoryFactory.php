<?php

namespace EmailMKT\Infrastructure\Persistence\Doctrine\Repository;

use Doctrine\ORM\EntityManager;
use EmailMKT\Domain\Entity\Tag;
use Interop\Container\ContainerInterface;

class TagRepositoryFactory
{
    function __invoke(ContainerInterface $container) : TagRepository
    {
        /** @var EntityManager $entityManager */
        $entityManager = $container->get(EntityManager::class);

        return $entityManager->getRepository(Tag::class);
    }

}