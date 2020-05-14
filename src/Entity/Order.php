<?php


namespace App\Entity;
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

    public function getCountry(): string
    {
        return (string) $this->country;
    }

}