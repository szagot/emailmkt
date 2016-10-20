<?php
/**
 * Entidade de Contato
 */

// Indica ao PHP para trabalhar no modo tipado.
// Isto é, quando indicado um tipo de variável ele deve ser obedecido.
declare(strict_types = 1);

namespace EmailMKT\Domain\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Customer
{
    private $id;
    private $name;
    private $email;

    // Um Costumer pode ter muitas tags
    private $tags;

    /**
     * Customer constructor.
     */
    public function __construct()
    {
        $this->tags = new ArrayCollection();
    }

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

    /**
     * @return Collection
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

}