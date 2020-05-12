<?php


namespace App\Entity;

/**
 * @ORM\Entity(repositoryClass=ShopList::class)
 */
class ShopList
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

}