<?php

namespace EmailMKT\Application\Form\Factory;

use EmailMKT\Application\Form\UserForm;
use EmailMKT\Application\InputFilter\UserInputFilter;
use EmailMKT\Domain\Entity\User;
use Interop\Container\ContainerInterface;
use Zend\Hydrator\ClassMethods;

class UserFormFactory
{
    public function __invoke(ContainerInterface $container) : UserForm
    {
        $form = new UserForm();

        // Hidratador: pega um array com os dados do form e seta as propriedades da entidade
        $form->setHydrator(new ClassMethods());
        $form->setObject(new User());

        // Validando User
        $form->setInputFilter(new UserInputFilter());

        return $form;
    }
}
