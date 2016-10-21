<?php

namespace EmailMKT\Infrastructure\Persistence\Doctrine\Repository;

use Doctrine\ORM\EntityManager;
use EmailMKT\Domain\Entity\User;
use Interop\Container\ContainerInterface;

class UserRepositoryFactory
{
    function __invoke(ContainerInterface $container) : UserRepository
    {
        /** @var EntityManager $entityManager */
        $entityManager = $container->get(EntityManager::class);

        return $entityManager->getRepository(User::class);
    }

}