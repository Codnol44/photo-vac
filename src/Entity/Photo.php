<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PhotoRepository")
 */
class Photo
{
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity=Photo::class, inversedBy="pays")
     * @ORM\GeneratedValue
     * @ORM\Column(name="id", type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(name="title", type="string", length=100, nullable=false)
     */
    private string $title;

    /**
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     * @Assert\NotBlank(message="Le titre est requis !")
     */
    private string $description;

    /**
     * @ORM\Column(name="year", type="integer", nullable=false)
     * @Assert\NotBlank(message="L'année est requise !")
     */
    private int $year;

    /**
     * @ORM\Column(name="photo", type="string", length=100, nullable=false)
     * @Assert\NotBlank(message="Une photo est requise !")
     */
    private string $photo;

    /**
     * @ORM\ManyToOne(targetEntity=Pays::class, inversedBy="photos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $pays;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return int
     */
    public function getYear(): int
    {
        return $this->year;
    }

    /**
     * @param int $year
     */
    public function setYear(int $year): void
    {
        $this->year = $year;
    }

    /**
     * @return string
     */
    public function getPhoto(): string
    {
        return $this->photo;
    }

    /**
     * @param string $photo
     */
    public function setPhoto(string $photo): void
    {
        $this->photo = $photo;
    }

}