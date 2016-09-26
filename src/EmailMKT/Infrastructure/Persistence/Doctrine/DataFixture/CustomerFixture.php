<?php
/**
 * Fixture: recurso de teste de desenvolvimento
 *
 * Para transferir, execute no terminal:
 *      vendor/bin/doctrine-module data-fixture:import
 *
 * Para apenas adicionar dados, sem limpar o BD:
 *      vendor/bin/doctrine-module data-fixture:import --append
 *
 * Para zerar o banco e também o auto-incremento, basta executar:
 *      vendor/bin/doctrine-module data-fixture:import --purge-with-truncate
 */

namespace EmailMKT\Infrastructure\Persistence\Doctrine\DataFixture;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use EmailMKT\Domain\Entity\Customer;
use Faker\Factory as Faker;

class CustomerFixture implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // Inicializando Faker
        $faker = Faker::create();

        // Criando 100 registros falsos
        foreach (range(1, 100) as $value) {
            // Dado fake
            $customer = new Customer();
            $customer
                ->setName($faker->firstName . ' ' . $faker->lastName)
                ->setEmail($faker->email);

            $manager->persist($customer);
        }

        // Registrando no BD
        $manager->flush();
    }
}