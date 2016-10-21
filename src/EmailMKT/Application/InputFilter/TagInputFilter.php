<?php
/**
 * Filtros e Validadores para Tag
 */

namespace EmailMKT\Application\InputFilter;

use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\InputFilter\InputFilter;
use Zend\Validator\NotEmpty;

class TagInputFilter extends InputFilter
{
    public function __construct()
    {
        $this->add([
            'name'       => 'name',
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
                            NotEmpty::IS_EMPTY => 'O nome da tag não pode estar vazio',
                        ]
                    ]
                ],
            ],
        ]);
    }

}