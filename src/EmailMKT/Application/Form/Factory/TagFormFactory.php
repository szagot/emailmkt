<?php

namespace EmailMKT\Application\Form\Factory;

use EmailMKT\Application\Form\TagForm;
use EmailMKT\Application\InputFilter\TagInputFilter;
use EmailMKT\Domain\Entity\Tag;
use Interop\Container\ContainerInterface;
use Zend\Hydrator\ClassMethods;

class TagFormFactory
{
    public function __invoke(ContainerInterface $container) : TagForm
    {
        $form = new TagForm();

        // Hidratador: pega um array com os dados do form e seta as propriedades da entidade
        $form->setHydrator(new ClassMethods());
        $form->setObject(new Tag());

        // Validando Tag
        $form->setInputFilter(new TagInputFilter());

        return $form;
    }
}
