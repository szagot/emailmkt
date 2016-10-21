<?php
/**
 * Filtros e Validadores para User
 */

namespace EmailMKT\Application\InputFilter;

use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\InputFilter\InputFilter;
use Zend\Validator\EmailAddress;
use Zend\Validator\NotEmpty;
use Zend\Validator\StringLength;

class UserInputFilter extends InputFilter
{
    public function __construct()
    {
        $this->add([
            'name'       => 'name',
            // Não é requerido
            'required'   => true,
            'filters'    => [
                // Limpa os espaços extras
                ['name' => StringTrim::class],
                // Limpa tags html
                ['name' => StripTags::class],
            ],
            'validators' => [
                // Valida se está vazio
                [
                    'name'                   => NotEmpty::class,
                    // Em caso de falha, para aqui, sem mostrar os demais erros.
                    'break_chain_on_failure' => true,
                    'options'                => [
                        'messages' => [
                            NotEmpty::IS_EMPTY => 'O nome do usuário não pode estar vazio',
                        ]
                    ]
                ],
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

        $this->add([
            'name'       => 'password',
            // Não é requerido
            'required'   => true,
            'filters'    => [
                // Limpa os espaços extras
                ['name' => StringTrim::class],
                // Limpa tags html
                ['name' => StripTags::class],
            ],
            'validators' => [
                // Valida se está vazio
                [
                    'name'                   => NotEmpty::class,
                    // Em caso de falha, para aqui, sem mostrar os demais erros.
                    'break_chain_on_failure' => true,
                    'options'                => [
                        'messages' => [
                            NotEmpty::IS_EMPTY => 'A senha não pode estar vazio',
                        ]
                    ]
                ],
                [
                    'name'                   => StringLength::class,
                    'break_chain_on_failure' => true,
                    'options'                => [
                        'min'      => 6,
                        'max'      => 15,
                        'encoding' => 'UTF-8',
                        'messages' => [
                            StringLength::INVALID   => 'A senha deve ter de 6 a 15 caracteres',
                            StringLength::TOO_SHORT => 'A senha deve ter de 6 a 15 caracteres',
                            StringLength::TOO_LONG  => 'A senha deve ter de 6 a 15 caracteres',
                        ]
                    ]
                ]
            ],
        ]);
    }

}