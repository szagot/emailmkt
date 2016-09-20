<?php
namespace EmailMKT\Application\Form;

use EmailMKT\Application\InputFilter\CustomerInputFilter;
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

        // Validando Customer
        $this->setInputFilter(new CustomerInputFilter());

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
            // Element\Email::class não usada por estar sendo validado em CustomerInputFilter
            // Pq senão ele mostra os erros em ingles referente eo email
            // No lugar, usa-se o atributo email*
            'type'       => Element\Text::class, # vide nota acima
            'options'    => [
                'label' => 'E-mail'
            ],
            'attributes' => [
                'id' => 'email',
                // *Este atributo
                'type' => 'email' # vide nota acima
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