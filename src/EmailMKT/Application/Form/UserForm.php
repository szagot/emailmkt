<?php
namespace EmailMKT\Application\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class UserForm extends Form
{
    public function __construct($name = 'user', array $options = [])
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
            // NOTA:
            // Element\Email::class não usada por estar sendo validado em UserInputFilter
            // Pq senão ele mostra os erros em ingles referente eo email
            // No lugar, usa-se o atributo email*
            'type'       => Element\Text::class, # vide nota acima
            'options'    => [
                'label' => 'E-mail'
            ],
            'attributes' => [
                'id'   => 'email',
                // *Este atributo
                'type' => 'email' # vide nota acima
            ],
        ]);

        $this->add([
            'name'       => 'password',
            'type'       => Element\Password::class,
            'options'    => [
                'label' => 'Senha'
            ],
            'attributes' => [
                'id' => 'password'
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