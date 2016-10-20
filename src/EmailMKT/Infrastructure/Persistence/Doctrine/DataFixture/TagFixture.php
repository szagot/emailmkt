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

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use EmailMKT\Domain\Entity\Tag;
use Faker\Factory as Faker;

class TagFixture extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // Inicializando Faker
        $faker = Faker::create();

        // Criando 100 registros falsos
        foreach (range(1, 100) as $key => $value) {
            // Dado fake
            $tag = new Tag();
            $tag->setName($faker->city);
            $this->addCustomers($tag);
            $manager->persist($tag);
        }

        // Registrando no BD
        $manager->flush();
    }

    /**
     * Adiciona Customers aleatórios a tag
     *
     * @param Tag $tag
     */
    public function addCustomers(Tag $tag)
    {
        $numCustomers = rand(1, 5);
        foreach (range(1, $numCustomers) as $value) {
            $index = rand(0, 99);
            $customer = $this->getReference("customer-$index");
            // Se repetiu, tenta novamente
            if ($tag->getCustomers()->exists(function ($key, $item) use ($customer) {
                return $customer->getId() == $item->getId();
            })
            ) {
                $index = rand(0, 99);
                $customer = $this->getReference("customer-$index");
            }

            $tag->getCustomers()->add($customer);
        }
    }

    /**
     * Qual a prioridade na execução desta fixture
     * Deve ser executada depois da fixture de Costumer
     *
     * @return mixed
     */
    public function getOrder()
    {
        return 200;
    }
}