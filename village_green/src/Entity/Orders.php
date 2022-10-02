<?php

namespace App\Entity;

use App\Repository\OrdersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrdersRepository::class)
 */
class Orders
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $order_date;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_payment;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_ship;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_delivery;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity=Lives::class, inversedBy="ordersbilling")
     * @ORM\JoinColumn(nullable=false)
     */
    private $LivesBilling;

    /**
     * @ORM\ManyToOne(targetEntity=Lives::class, inversedBy="ordersdelivery")
     * @ORM\JoinColumn(nullable=false)
     */
    private $LivesDelivery;

    /**
     * @ORM\OneToMany(targetEntity=OrdersDetails::class, mappedBy="orders")
     */
    private $ordersDetails;

    /**
     * @ORM\ManyToOne(targetEntity=Customers::class, inversedBy="orders")
     * @ORM\JoinColumn(nullable=false)
     */
    private $customer;

    public function __construct()
    {
        $this->ordersDetails = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrderDate(): ?\DateTimeInterface
    {
        return $this->order_date;
    }

    public function setOrderDate(\DateTimeInterface $order_date): self
    {
        $this->order_date = $order_date;

        return $this;
    }

    public function getDatePayment(): ?\DateTimeInterface
    {
        return $this->date_payment;
    }

    public function setDatePayment(\DateTimeInterface $date_payment): self
    {
        $this->date_payment = $date_payment;

        return $this;
    }

    public function getDateShip(): ?\DateTimeInterface
    {
        return $this->date_ship;
    }

    public function setDateShip(\DateTimeInterface $date_ship): self
    {
        $this->date_ship = $date_ship;

        return $this;
    }

    public function getDateDelivery(): ?\DateTimeInterface
    {
        return $this->date_delivery;
    }

    public function setDateDelivery(?\DateTimeInterface $date_delivery): self
    {
        $this->date_delivery = $date_delivery;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getLivesBilling(): ?Lives
    {
        return $this->LivesBilling;
    }

    public function setLivesBilling(?Lives $LivesBilling): self
    {
        $this->LivesBilling = $LivesBilling;

        return $this;
    }

    public function getLivesDelivery(): ?Lives
    {
        return $this->LivesDelivery;
    }

    public function setLivesDelivery(?Lives $LivesDelivery): self
    {
        $this->LivesDelivery = $LivesDelivery;

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
            $ordersDetail->setOrders($this);
        }

        return $this;
    }

    public function removeOrdersDetail(OrdersDetails $ordersDetail): self
    {
        if ($this->ordersDetails->removeElement($ordersDetail)) {
            // set the owning side to null (unless already changed)
            if ($ordersDetail->getOrders() === $this) {
                $ordersDetail->setOrders(null);
            }
        }

        return $this;
    }

    public function getCustomer(): ?Customers
    {
        return $this->customer;
    }

    public function setCustomer(?Customers $customer): self
    {
        $this->customer = $customer;

        return $this;
    }

    public function __toString()
    {
        return $this->id;
    }
}
