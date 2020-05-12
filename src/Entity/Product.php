<?php


namespace App\Entity;

/**
 * @ORM\Entity(repositoryClass=Product::class)
 */
class Product
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
     * @ORM\Column(type="string")
     */
    private $name;

    public function getName(): string
    {
        return (string) $this->name;
    }

    /**
     * @ORM\Column(type="integer")
     */
    private $cost;

    public function getCost(): string
    {
        return (string) $this->cost;
    }

    /**
     * @ORM\Column(type="string")
     */
    private $description;

    public function getDescription(): string
    {
        return (string) $this->description;
    }

}