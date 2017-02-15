<?php
/**
 * Entidade de Tags (Many to Many com Tag)
 */

// Indica ao PHP para trabalhar no modo tipado.
// Isto é, quando indicado um tipo de variável ele deve ser obedecido.
declare(strict_types = 1);

namespace EmailMKT\Domain\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Tag
{
    private $id;
    private $name;

    // Uma Tag pode ter muitos Costumers
    private $customers;

    // Uma Tag pode ter muitas Campanhas
    private $campaigns;

    /**
     * Tag constructor.
     */
    public function __construct()
    {
        $this->customers = new ArrayCollection();
        $this->campaigns = new ArrayCollection();
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

    /**
     * @return Collection
     */
    public function getCustomers(): Collection
    {
        return $this->customers;
    }

    /**
     * @return Collection
     */
    public function getCampaigns(): Collection
    {
        return $this->campaigns;
    }


}