<?php

namespace App\Entity;

use App\Repository\EmployeesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=EmployeesRepository::class)
 */
class Employees
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @groups({"show_product","showemp"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @groups({"show_product","showemp"})
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     * @groups({"show_product","showemp"})
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=15)
     * @groups({"show_product","showemp"})
     */
    private $tel;

    /**
     * @ORM\ManyToOne(targetEntity=Lives::class, inversedBy="employees")
     * @ORM\JoinColumn(nullable=false)
     */
    private $live;

    /**
     * @ORM\OneToMany(targetEntity=Products::class, mappedBy="emp")
     */
    private $products;

    /**
     * @ORM\OneToOne(targetEntity=Users::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $users;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    public function getLive(): ?Lives
    {
        return $this->live;
    }

    public function setLive(?Lives $live): self
    {
        $this->live = $live;

        return $this;
    }

    /**
     * @return Collection<int, Products>
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Products $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
            $product->setEmp($this);
        }

        return $this;
    }

    public function removeProduct(Products $product): self
    {
        if ($this->products->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getEmp() === $this) {
                $product->setEmp(null);
            }
        }

        return $this;
    }

    public function getUsers(): ?Users
    {
        return $this->users;
    }

    public function setUsers(?Users $users): self
    {
        $this->users = $users;

        return $this;
    }

    public function __toString()
    {
        return $this->lastname;
    }
}
