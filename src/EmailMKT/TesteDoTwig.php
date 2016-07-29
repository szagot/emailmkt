<?php
/**
 * Testando a tag do do Twig
 */

namespace EmailMKT;


class TesteDoTwig
{
    const CONSTANTE_TESTE = 'Constante linda!';

    private $nome;

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

}