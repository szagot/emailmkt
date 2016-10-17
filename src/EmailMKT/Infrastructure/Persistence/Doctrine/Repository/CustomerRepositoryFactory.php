<?php

namespace EmailMKT\Infrastructure\Persistence\Doctrine\Repository;

use Doctrine\ORM\EntityManager;
use EmailMKT\Domain\Entity\Customer;
use Interop\Container\ContainerInterface;

class CustomerRepositoryFactory
{
    function __invoke(ContainerInterface $container) : CustomerRepository
    {
        /** @var EntityManager $entityManager */
        $entityManager = $container->get(EntityManager::class);

        return $entityManager->getRepository(Customer::class);
    }

}