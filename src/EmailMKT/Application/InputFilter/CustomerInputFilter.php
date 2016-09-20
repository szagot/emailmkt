<?php
/**
 * Filtros e Validadores para Customer
 */

namespace EmailMKT\Application\InputFilter;

use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\InputFilter\InputFilter;
use Zend\Validator\EmailAddress;
use Zend\Validator\NotEmpty;

class CustomerInputFilter extends InputFilter
{
    public function __construct()
    {
        $this->add([
            'name'     => 'name',
            // Não é requerido
            'required' => false,
            'filters'  => [
                // Limpa os espaços extras
                ['name' => StringTrim::class],
                // Limpa tags html
                ['name' => StripTags::class],
            ],
        ]);

        $this->add([
            'name'       => 'email',
            'required'   => true,
            'filters'    => [
                // Limpa os espaços extras
                ['name' => StringTrim::class],
            ],
            'validators' => [
                // Valida se está vazio
                [
                    'name'                   => NotEmpty::class,
                    // Em caso de falha, para aqui, sem mostrar os demais erros.
                    'break_chain_on_failure' => true,
                    'options'                => [
                        'messages' => [
                            NotEmpty::IS_EMPTY => 'O email não pode estar vazio',
                        ]
                    ]
                ],
                // Valida o formato do email
                [
                    'name'    => EmailAddress::class,
                    'options' => [
                        'messages' => [
                            EmailAddress::INVALID_FORMAT => 'Por favor, informe um email válido',
                        ]
                    ]
                ],
            ],
        ]);
    }

}