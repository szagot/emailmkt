<?php
/**
 * Entidade de Contato
 */

// Indica ao PHP para trabalhar no modo tipado.
// Isto é, quando indicado um tipo de variável ele deve ser obedecido.
declare(strict_types = 1);

namespace EmailMKT\Domain\Entity;

class Customer
{
    private $id;
    private $name;
    private $email;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return Customer
     */
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     *
     * @return Customer
     */
    public function setEmail(string $email)
    {
        $this->email = $email;

        return $this;
    }

}