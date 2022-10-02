<?php

namespace App\Entity;

use App\Repository\ProductsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ProductsRepository::class)
 */
class Products
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"show_product"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"show_product"})
     * @Assert\NotBlank
     * @Assert\Length(min=3)
     */
    private $name;

    /**
     * @ORM\Column(type="text", length=65535)
     * @Groups({"show_product"})
     * @Assert\NotBlank
     * @Assert\Length(min=3)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"show_product"})
     * @Assert\NotBlank
     * @Assert\Length(min=3)
     */
    private $photo;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"show_product"})
     * @Assert\NotBlank
     * @Assert\Length(min=3)
     */
    private $label;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"show_product"})
     * @Assert\NotBlank
     * @Assert\Length(min=3)
     */
    private $ref;

    /**
     * @ORM\Column(type="decimal", precision=6, scale=2)
     * @Groups({"show_product"})
     * @Assert\NotBlank
     * @Assert\Length(min=3)
     */
    private $price;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"show_product"})
     * @Assert\NotBlank
     * @Assert\Length(min=1)
     */
    private $status;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"show_product"})
     * @Assert\NotBlank
     */
    private $stock;

    /**
     * @ORM\ManyToOne(targetEntity=Categories::class, inversedBy="parentcat")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"show_product"})
     * @Assert\NotBlank
     */
    private $catprod;

    /**
     * @ORM\ManyToOne(targetEntity=Employees::class, inversedBy="products")
     * @ORM\JoinColumn(nullable=false)
     *  @Groups({"show_product"})
     * @Assert\NotBlank
     * @Assert\Length(min=3)
     */
    private $emp;

    /**
     * @ORM\OneToMany(targetEntity=OrdersDetails::class, mappedBy="product")
     */
    private $ordersDetails;

    public function __construct()
    {
        $this->ordersDetails = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getRef(): ?string
    {
        return $this->ref;
    }

    public function setRef(string $ref): self
    {
        $this->ref = $ref;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    public function getCatprod(): ?Categories
    {
        return $this->catprod;
    }

    public function setCatprod(?Categories $catprod): self
    {
        $this->catprod = $catprod;

        return $this;
    }

    public function getEmp(): ?employees
    {
        return $this->emp;
    }

    public function setEmp(?employees $emp): self
    {
        $this->emp = $emp;

        return $this;
    }

    /**
     * @return Collection<int, OrdersDetails>
     */
    public function getOrdersDetails(): Collection
    {
        return $this->ordersDetails;
    }

    public function addOrdersDetail(OrdersDetails $ordersDetail): self
    {
        if (!$this->ordersDetails->contains($ordersDetail)) {
            $this->ordersDetails[] = $ordersDetail;
            $ordersDetail->setProduct($this);
        }

        return $this;
    }

    public function removeOrdersDetail(OrdersDetails $ordersDetail): self
    {
        if ($this->ordersDetails->removeElement($ordersDetail)) {
            // set the owning side to null (unless already changed)
            if ($ordersDetail->getProduct() === $this) {
                $ordersDetail->setProduct(null);
            }
        }

        return $this;
    }


}
