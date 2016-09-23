<?php

namespace EmailMKT\Application\Form\Factory;

use EmailMKT\Application\Form\CustomerForm;
use EmailMKT\Application\InputFilter\CustomerInputFilter;
use EmailMKT\Domain\Entity\Customer;
use Interop\Container\ContainerInterface;
use Zend\Hydrator\ClassMethods;

class CustomerFormFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $form = new CustomerForm();

        // Hidratador: pega um array com os dados do form e seta as propriedades da entidade
        $form->setHydrator(new ClassMethods());
        $form->setObject(new Customer());

        // Validando Customer
        $form->setInputFilter(new CustomerInputFilter());

        return $form;
    }
}
