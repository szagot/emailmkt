<?php

namespace EmailMKT\Application\Form\Factory;

use EmailMKT\Application\Form\LoginForm;
use EmailMKT\Application\InputFilter\LoginInputFilter;
use Interop\Container\ContainerInterface;
use Zend\Hydrator\ClassMethods;

class LoginFormFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $form = new LoginForm();

        // Hidratador: pega um array com os dados do form e seta as propriedades da entidade
//        $form->setHydrator(new ClassMethods());
//        $form->setObject(new Customer());

        // Validando Customer
        $form->setInputFilter(new LoginInputFilter());

        return $form;
    }
}
