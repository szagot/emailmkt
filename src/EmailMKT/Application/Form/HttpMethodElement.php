<?php
/**
 * Criação de método fake para formulários (PUT, DELETE, PATCH)
 */

namespace EmailMKT\Application\Form;

use Zend\Form\Element\Hidden;

class HttpMethodElement extends Hidden
{
    const PUT = 'PUT';
    const DEL = 'DELETE';
    CONST PAT = 'PATCH';

    public function __construct($value, array $options = [])
    {
        parent::__construct('_method', $options);
        $this->setValue($value);
    }
}