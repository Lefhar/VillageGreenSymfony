<?php

namespace App\Entity;

use App\Repository\LiveRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LiveRepository::class)
 */
class Lives
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $zipcode;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $country;

    /**
     * @ORM\OneToMany(targetEntity=Employees::class, mappedBy="live")
     */
    private $employees;

    /**
     * @ORM\ManyToMany(targetEntity=Customers::class, mappedBy="live")
     */
    private $customers;

    /**
     * @ORM\Column(type="integer")
     */
    private $type;

    /**
     * @ORM\OneToMany(targetEntity=Orders::class, mappedBy="LivesBilling")
     */
    private $ordersbilling;

    /**
     * @ORM\OneToMany(targetEntity=Orders::class, mappedBy="LivesDelivery")
     */
    private $ordersdelivery;

    public function __construct()
    {
        $this->employees = new ArrayCollection();
        $this->customers = new ArrayCollection();
        $this->ordersbilling = new ArrayCollection();
        $this->ordersdelivery = new ArrayCollection();
    }




    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getZipcode(): ?string
    {
        return $this->zipcode;
    }

    public function setZipcode(string $zipcode): self
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return Collection<int, Employees>
     */
    public function getEmployees(): Collection
    {
        return $this->employees;
    }

    public function addEmployee(Employees $employee): self
    {
        if (!$this->employees->contains($employee)) {
            $this->employees[] = $employee;
            $employee->setLive($this);
        }

        return $this;
    }

    public function removeEmployee(Employees $employee): self
    {
        if ($this->employees->removeElement($employee)) {
            // set the owning side to null (unless already changed)
            if ($employee->getLive() === $this) {
                $employee->setLive(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Customers>
     */
    public function getCustomers(): Collection
    {
        return $this->customers;
    }

    public function addCustomer(Customers $customer): self
    {
        if (!$this->customers->contains($customer)) {
            $this->customers[] = $customer;
            $customer->addLive($this);
        }

        return $this;
    }

    public function removeCustomer(Customers $customer): self
    {
        if ($this->customers->removeElement($customer)) {
            $customer->removeLive($this);
        }

        return $this;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(int $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection<int, Orders>
     */
    public function getOrdersbilling(): Collection
    {
        return $this->ordersbilling;
    }

    public function addOrdersbilling(Orders $ordersbilling): self
    {
        if (!$this->ordersbilling->contains($ordersbilling)) {
            $this->ordersbilling[] = $ordersbilling;
            $ordersbilling->setLivesBilling($this);
        }

        return $this;
    }

    public function removeOrdersbilling(Orders $ordersbilling): self
    {
        if ($this->ordersbilling->removeElement($ordersbilling)) {
            // set the owning side to null (unless already changed)
            if ($ordersbilling->getLivesBilling() === $this) {
                $ordersbilling->setLivesBilling(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Orders>
     */
    public function getOrdersdelivery(): Collection
    {
        return $this->ordersdelivery;
    }

    public function addOrdersdelivery(Orders $ordersdelivery): self
    {
        if (!$this->ordersdelivery->contains($ordersdelivery)) {
            $this->ordersdelivery[] = $ordersdelivery;
            $ordersdelivery->setLivesDelivery($this);
        }

        return $this;
    }

    public function removeOrdersdelivery(Orders $ordersdelivery): self
    {
        if ($this->ordersdelivery->removeElement($ordersdelivery)) {
            // set the owning side to null (unless already changed)
            if ($ordersdelivery->getLivesDelivery() === $this) {
                $ordersdelivery->setLivesDelivery(null);
            }
        }

        return $this;
    }




}
