<?php
/**
 * Entidade de Tags (Many to Many com Tag)
 */

// Indica ao PHP para trabalhar no modo tipado.
// Isto é, quando indicado um tipo de variável ele deve ser obedecido.
declare(strict_types = 1);

namespace EmailMKT\Domain\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class Tag
{
    private $id;
    private $name;

    // Uma Tag pode ter muitos Costumers
    private $customers;

    /**
     * Tag constructor.
     */
    public function __construct()
    {
        $this->customers = new ArrayCollection();
    }

    /**
     * @return int|null
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
     * @return Tag
     */
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

}