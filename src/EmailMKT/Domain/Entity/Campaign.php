<?php
/**
 * Entidade de Campanha
 */

namespace EmailMKT\Domain\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Campaign
{
    private $id;
    private $name;
    private $template;
    private $tags;

    /**
     * Campaign constructor.
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
     * @return Campaign
     */
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * @param string $template
     *
     * @return Campaign
     */
    public function setTemplate(string $template)
    {
        $this->template = $template;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTags(Collection $tags)
    {
        /** @var Tag $tag */
        foreach ($tags as $tag) {
            // Adicionando Customer na Tag
            $tag->getCustomers()->add($this);
            // Adicionando Tag no Customer
            $this->tags->add($tag);
        }

        return $this;
    }

    public function removeTags(Collection $tags)
    {
        /** @var Tag $tag */
        foreach ($tags as $tag) {
            // Removendo Customer na Tag
            $tag->getCustomers()->removeElement($this);
            // Removendo Tag no Customer
            $this->tags->removeElement($tag);
        }

        return $this;
    }

}