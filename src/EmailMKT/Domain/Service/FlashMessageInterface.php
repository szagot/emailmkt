<?php
/**
 * Interface de serviço para as Flash Messages
 */

// Indica ao PHP para trabalhar no modo tipado.
// Isto é, quando indicado um tipo de variável primitivo, ele deve ser obedecido.
declare(strict_types = 1);

namespace EmailMKT\Domain\Service;

interface FlashMessageInterface
{
    const MESSAGE_SUCCESS = 0;
    const MESSAGE_ERROR = 1;

    /**
     * Cria um namespace (um container) na nossa seção
     *
     * @param string $namespace
     */
    public function setNamespace(string $namespace);

    /**
     * Seta uma flash message
     *
     * @param        $key
     * @param string $value
     */
    public function setMessage($key, string $value);

    /**
     * Pega uma mensagem
     *
     * @param $key
     *
     * @return string Mensagem
     */
    public function getMessage($key);
}