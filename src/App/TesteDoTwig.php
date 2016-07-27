<?php
/**
 * Testando a tag do do Twig
 */

namespace App;


class TesteDoTwig
{
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