<?php

namespace EmailMKT\Infrastructure\Service;

use Aura\Session\Segment;
use Aura\Session\Session;
use EmailMKT\Domain\Service\FlashMessageInterface;

class FlashMessage implements FlashMessageInterface
{
    /**
     * @var Session
     */
    private $session;

    /**
     * @var Segment
     */
    private $segment;

    public function __construct(Session $session)
    {
        $this->session = $session;

        // A sessão foi iniciada?
        if (! $this->session->isStarted()) {
            $this->session->start();
        }
    }

    public function setNamespace($namespace = __NAMESPACE__)
    {
        // Pega (ou cria, se ainda não existir) um segmento de seção
        $this->segment = $this->session->getSegment($namespace);

        return $this;
    }

    public function setMessage($key, $value)
    {
        // Se o segmento não existir, cria um segmento padrão
        if (! $this->segment) {
            $this->setNamespace();
        }

        // Seta a flash message
        $this->segment->setFlash($key, $value);

        return $this;
    }

    public function getMessage($key)
    {
        // Se o segmento não existir, cria um segmento padrão
        if (! $this->segment) {
            $this->setNamespace();
        }

        return $this->segment->getFlash($key);
    }
}