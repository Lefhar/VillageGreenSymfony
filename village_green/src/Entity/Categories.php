<?php

namespace App\Entity;

use App\Repository\CategoriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=CategoriesRepository::class)
 */
class Categories
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"show_product","showcat"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"show_product","showcat"})
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=Categories::class, inversedBy="Parent")
     *
     */
    private $souscat;

    /**
     * @ORM\OneToMany(targetEntity=Categories::class, mappedBy="souscat")
       * @Groups({"showcat"})
     */
    private $Parent;

    /**
     * @ORM\OneToMany(targetEntity=Products::class, mappedBy="catprod")
     *
     */
    private $parentcat;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $picture;


    public function __construct()
    {
        $this->Parent = new ArrayCollection();
        $this->parentcat = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSouscat(): ?self
    {
        return $this->souscat;
    }

    public function setSouscat(?self $souscat): self
    {
        $this->souscat = $souscat;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getParent(): Collection
    {
        return $this->Parent;
    }

    public function addParent(self $parent): self
    {
        if (!$this->Parent->contains($parent)) {
            $this->Parent[] = $parent;
            $parent->setSouscat($this);
        }

        return $this;
    }

    public function removeParent(self $parent): self
    {
        if ($this->Parent->removeElement($parent)) {
            // set the owning side to null (unless already changed)
            if ($parent->getSouscat() === $this) {
                $parent->setSouscat(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Products>
     */
    public function getParentcat(): Collection
    {
        return $this->parentcat;
    }

    public function addParentcat(Products $parentcat): self
    {
        if (!$this->parentcat->contains($parentcat)) {
            $this->parentcat[] = $parentcat;
            $parentcat->setCatprod($this);
        }

        return $this;
    }

    public function removeParentcat(Products $parentcat): self
    {
        if ($this->parentcat->removeElement($parentcat)) {
            // set the owning side to null (unless already changed)
            if ($parentcat->getCatprod() === $this) {
                $parentcat->setCatprod(null);
            }
        }

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}
