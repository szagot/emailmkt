<?php

namespace EmailMKT\Infrastructure\Service;

use EmailMKT\Domain\Service\FlashMessageInterface;
use Zend\Mvc\Controller\Plugin\FlashMessenger;

class FlashMessage implements FlashMessageInterface
{
    /**
     * @var FlashMessenger
     */
    private $flashMessenger;

    public function __construct(FlashMessenger $flashMessenger)
    {
        $this->flashMessenger = $flashMessenger;
    }

    public function setNamespace(string $namespace = __NAMESPACE__) : FlashMessage
    {
        // Pega (ou cria, se ainda não existir) um segmento de seção
        $this->flashMessenger->setNamespace($namespace);

        return $this;
    }

    public function setMessage($key, string $value) : FlashMessage
    {
        // Seta a flash message de a cordo com o tipo
        switch ($key) {
            // Sucesso
            case self::MESSAGE_SUCCESS:
                $this->flashMessenger->addSuccessMessage($value);
                break;

            // Falha
            case self::MESSAGE_ERROR:
                $this->flashMessenger->addErrorMessage($value);
                break;
        }

        return $this;
    }

    public function getMessage($key)
    {
        $return = [];
        switch ($key) {
            // Sucesso
            case self::MESSAGE_SUCCESS:
                $return = $this->flashMessenger->getSuccessMessages();
                break;

            // Falha
            case self::MESSAGE_ERROR:
                $return = $this->flashMessenger->getErrorMessages();
                break;
        }

        return count($return) ? $return[ 0 ] : null;
    }
}