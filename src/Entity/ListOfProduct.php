<?php


namespace App\Entity;

/**
 * @ORM\Entity(repositoryClass=ListOfProduct::class)
 */
class ListOfProduct
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