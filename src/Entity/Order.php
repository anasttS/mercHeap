<?php


namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=Order::class)
 */
class Order
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

    /**
     * @ORM\Column(type="string", length=180)
     */
    private $lastName;

    public function getLastName(): string
    {
        return (string) $this->lastName;
    }

    /**
     * @ORM\Column(type="string", length=180)
     */
    private $address;

    public function getAddress(): string
    {
        return (string) $this->address;
    }

    /**
     * @ORM\Column(type="string", length=180)
     */
    private $country;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="orders")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=ShopList::class, mappedBy="orderId", orphanRemoval=true)
     */
    private $shopLists;

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

}