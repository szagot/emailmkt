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
use EmailMKT\Domain\Entity\User;
use Faker\Factory as Faker;

class UserFixture implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // Inicializando Faker
        $faker = Faker::create();

        $user = new User();
        $user
            ->setName('Admin')
            ->setEmail('szagot@gmail.com')
            ->setPlainPassword('DSpider');

        $manager->persist($user);

        // Criando 10 registros falsos
        foreach (range(1, 10) as $value) {
            // Dado fake
            $user = new User();
            $user
                ->setName($faker->userName)
                ->setEmail($faker->email)
                ->setPlainPassword($faker->password());

            $manager->persist($user);
        }

        // Registrando no BD
        $manager->flush();
    }
}