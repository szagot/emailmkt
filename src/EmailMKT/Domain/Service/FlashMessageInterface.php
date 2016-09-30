<?php
/**
 * Interface de serviço para as Flash Messages
 */
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
    public function setNamespace($namespace);

    /**
     * Seta uma flash message
     *
     * @param        $key
     * @param string $value
     */
    public function setMessage($key, $value);

    /**
     * Pega uma mensagem
     *
     * @param $key
     *
     * @return string Mensagem
     */
    public function getMessage($key);
}