<?php
/**
 * Fixture: recurso de teste de desenvolvimento
 * Para transferir, execute no terminal:
 *      vendor/bin/doctrine-module data-fixture:import
 */

namespace EmailMKT\Infrastructure\Persistence\Doctrine\DataFixture;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use EmailMKT\Domain\Entity\Customer;

class CustomerFixture implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // Dado fake
        $customer = new Customer();
        $customer->setName('Daniel Bispo')->setEmail('daniel@tmw.com.br');

        // Registrando no BD
        $manager->persist($customer);
        $manager->flush();
    }
}