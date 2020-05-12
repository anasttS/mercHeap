<?php


namespace App\Entity;

/**
 * @ORM\Entity(repositoryClass=Photo::class)
 */
class Photo
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
    private $path;

    public function getPath(): string
    {
        return (string) $this->path;
    }

}