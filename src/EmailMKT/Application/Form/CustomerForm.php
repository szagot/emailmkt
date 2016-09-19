<?php
namespace EmailMKT\Application\Form;

use EmailMKT\Domain\Entity\Customer;
use Zend\Form\Form;
use Zend\Form\Element;
use Zend\Hydrator\ClassMethods;

class CustomerForm extends Form
{
    public function __construct($name = 'customer', array $options = [])
    {
        parent::__construct($name, $options);

        // Hidratador: pega um array com os dados do form e seta as propriedades da entidade
        $this->setHydrator(new ClassMethods());
        $this->setObject(new Customer());

        // Adicionando Campos
        $this->add([
            'name' => 'id',
            'type' => Element\Hidden::class
        ]);

        $this->add([
            'name'       => 'name',
            'type'       => Element\Text::class,
            'options'    => [
                'label' => 'Nome'
            ],
            'attributes' => [
                'id' => 'name'
            ],
        ]);

        $this->add([
            'name'       => 'email',
            'type'       => Element\Email::class,
            'options'    => [
                'label' => 'E-mail'
            ],
            'attributes' => [
                'id' => 'email'
            ],
        ]);

        $this->add([
            'name'       => 'submit',
            'type'       => Element\Button::class,
            'attributes' => [
                'type' => 'submit'
            ],
            'options'    => [
                'label_options' => [
                    'disable_html_escape' => true, #permite html no label
                ]
            ]
        ]);
    }
}