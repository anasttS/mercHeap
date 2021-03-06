<?php


namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\OrderRepository;

/**
 * @ORM\Entity(repositoryClass=OrderRepository::class)
 */
class OrderUser
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @ORM\Column(type="string", length=180)
     */
    private $firstName;

    public function getFirstName(): string
    {
        return (string) $this->firstName;
    }

    public function setFirstName(String $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * @ORM\Column(type="string", length=180)
     */
    private $lastName;

    public function getLastName(): string
    {
        return (string) $this->lastName;
    }

    public function setLastName(String $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * @ORM\Column(type="string", length=180)
     */
    private $address;

    public function getAddress(): string
    {
        return (string) $this->address;
    }

    public function setAddress(String $address): self
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @ORM\Column(type="string", length=180)
     */
    private $country;

    public function setCountry(String $country): self
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="orders")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=ShopList::class, mappedBy="orderId", cascade={"persist"})
     */
    private $shopLists;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    /**
     * @ORM\Column(type="integer")
     */
    private $zipCode;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $phoneNumber;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $priceOf;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $subtotalOf;

    public function __construct()
    {
        $this->shopLists = new ArrayCollection();
    }

    public function getCountry(): string
    {
        return (string) $this->country;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|ShopList[]
     */
    public function getShopLists(): Collection
    {
        return $this->shopLists;
    }

    public function addShopList(ShopList $shopList): self
    {
        if (!$this->shopLists->contains($shopList)) {
            $this->shopLists[] = $shopList;
            $shopList->setOrderId($this);
        }

        return $this;
    }


    public function removeShopList(ShopList $shopList): self
    {
        if ($this->shopLists->contains($shopList)) {
            $this->shopLists->removeElement($shopList);
            // set the owning side to null (unless already changed)
            if ($shopList->getOrderId() === $this) {
                $shopList->setOrderId(null);
            }
        }

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

    public function getZip(): ?int
    {
        return $this->zipCode;
    }

    public function setZip(int $zipCode): self
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phone): self
    {
        $this->phoneNumber = $phone;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->priceOf;
    }

    public function setPrice(int $priceOf): self
    {
        $this->priceOf = $priceOf;

        return $this;
    }

    public function getSubtotal(): ?int
    {
        return $this->subtotalOf;
    }

    public function setSubtotal(int $subtotalOf): self
    {
        $this->subtotalOf = $subtotalOf;

        return $this;
    }

}