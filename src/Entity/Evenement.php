<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Evenement
 *
 * @ORM\Table(name="evenement")
 * @ORM\Entity
 */
class Evenement
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
     *@Assert\NotBlank(message = "Le champ 'Nom' ne doit pas être vide.")

     * @ORM\Column(name="Nom", type="string", length=500, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *@Assert\NotBlank(message = "Le champ 'Type' ne doit pas être vide.")
     * @ORM\Column(name="Type", type="string", length=500, nullable=false)
     */
    private $type;

    /**
     * @var \Date
     *@Assert\NotBlank(message = "Le champ 'Date' ne doit pas être vide.")
     * @ORM\Column(name="DteEve", type="date", nullable=false)
     */
    private $dteeve;

    /**
     * @var string
     *@Assert\NotBlank(message = "Le champ 'Lieu' ne doit pas être valide.")
     * @ORM\Column(name="LieuEve", type="string", length=500, nullable=false)
     */
    private $lieueve;

    /**
     * @var string
     *@Assert\NotBlank(message = "Le champ 'Heure' ne doit pas être vide.")
     * @ORM\Column(name="HrEve", type="string", nullable=false)
     */
    private $hreve;

    /**
     * @var string
     *@Assert\NotBlank(message = "Le champ 'Description' ne doit pas être vide.")
     * @ORM\Column(name="DescrEve", type="string", length=500, nullable=false)
     */
    private $descreve;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getDteeve(): ?\DateTimeInterface
    {
        return $this->dteeve;
    }

    public function setDteeve(\DateTimeInterface $dteeve): self
    {
        $this->dteeve = $dteeve;

        return $this;
    }

    public function getLieueve(): ?string
    {
        return $this->lieueve;
    }

    public function setLieueve(string $lieueve): self
    {
        $this->lieueve = $lieueve;

        return $this;
    }

    public function getHreve(): ?string
    {
        return $this->hreve;
    }

    public function setHreve(string $hreve): self
    {
        $this->hreve = $hreve;

        return $this;
    }

    public function getDescreve(): ?string
    {
        return $this->descreve;
    }

    public function setDescreve(string $descreve): self
    {
        $this->descreve = $descreve;

        return $this;
    }


}
