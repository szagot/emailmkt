<?php

namespace EmailMKT\Application\Form\Factory;

use EmailMKT\Application\Form\LoginForm;
use EmailMKT\Application\InputFilter\LoginInputFilter;
use Interop\Container\ContainerInterface;

class LoginFormFactory
{
    public function __invoke(ContainerInterface $container) : LoginForm
    {
        $form = new LoginForm();

        // Validando Customer
        $form->setInputFilter(new LoginInputFilter());

        return $form;
    }
}
