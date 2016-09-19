<?php
namespace EmailMKT\Application\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class CustomerForm extends Form
{
    public function __construct($name = 'customer', array $options = [])
    {
        parent::__construct($name, $options);

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