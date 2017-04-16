<?php
/**
 * Filtros e Validadores para Campaign
 */

namespace EmailMKT\Application\InputFilter;

use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\InputFilter\InputFilter;
use Zend\Validator\NotEmpty;

class CampaignInputFilter extends InputFilter
{
    public function __construct()
    {
        $this->add([
            'name'     => 'name',
            // Não é requerido
            'required' => true,
            'filters'  => [
                // Limpa os espaços extras
                ['name' => StringTrim::class],
                // Limpa tags html
                ['name' => StripTags::class],
            ],
            'validators' => [
                [
                    'name'                   => NotEmpty::class,
                    'break_chain_on_failure' => true,
                    'options'                => [
                        'messages' => [
                            NotEmpty::IS_EMPTY => 'Este campo é requerido'
                        ]
                    ]
                ]
            ],
        ]);

        $this->add([
            'name'     => 'subject',
            // Não é requerido
            'required' => true,
            'filters'  => [
                // Limpa os espaços extras
                ['name' => StringTrim::class],
                // Limpa tags html
                ['name' => StripTags::class],
            ],
            'validators' => [
                [
                    'name'                   => NotEmpty::class,
                    'break_chain_on_failure' => true,
                    'options'                => [
                        'messages' => [
                            NotEmpty::IS_EMPTY => 'Este campo é requerido'
                        ]
                    ]
                ]
            ],
        ]);

        $this->add([
            'name'       => 'template',
            // Não é requerido
            'required'   => true,
            'validators' => [
                [
                    'name'                   => NotEmpty::class,
                    'break_chain_on_failure' => true,
                    'options'                => [
                        'messages' => [
                            NotEmpty::IS_EMPTY => 'Este campo é requerido'
                        ]
                    ]
                ]
            ],
        ]);

    }

}