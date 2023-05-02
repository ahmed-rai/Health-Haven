<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Conseil
 *
 * @ORM\Table(name="conseil")
 * @ORM\Entity
 */
#[ORM\Entity(repositoryClass: ConseilRepository::class )]

class Conseil
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *@Assert\NotBlank(message = "Le champ 'Titre' ne doit pas être vide.")
     * @ORM\Column(name="titre", type="string", length=500, nullable=false)
     */
    private $titre;

    /**
     * @var string
     *@Assert\NotBlank(message = "Le champ 'Description' ne doit pas être vide.")
     * @ORM\Column(name="description", type="string", length=500, nullable=false)
     */
    private $description;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }


}
