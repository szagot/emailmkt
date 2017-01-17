<?php

namespace EmailMKT\Application\Form\Factory;

use Doctrine\ORM\EntityManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use EmailMKT\Application\Form\CustomerForm;
use EmailMKT\Application\InputFilter\CustomerInputFilter;
use EmailMKT\Domain\Entity\Customer;
use Interop\Container\ContainerInterface;
use Zend\Hydrator\ClassMethods;

class CustomerFormFactory
{
    public function __invoke(ContainerInterface $container): CustomerForm
    {
        $entityManager = $container->get(EntityManager::class);

        $form = new CustomerForm();

        // Hidratador: pega um array com os dados do form e seta as propriedades da entidade
        $form->setHydrator(new DoctrineObject($entityManager));
        $form->setObject(new Customer());

        // Validando Customer
        $form->setInputFilter(new CustomerInputFilter());

        // Setando o ObjectManager para controle de tags do Contato
        $form->setObjectManager($entityManager);

        // Inicia o form (faz-se necessário devido ao ObjectManager)
        $form->init();

        return $form;
    }
}
