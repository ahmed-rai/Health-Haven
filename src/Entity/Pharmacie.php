<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Pharmacie
 *
 * @ORM\Table(name="pharmacie")
 * @ORM\Entity
 */
class Pharmacie
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
     *
     * @ORM\Column(name="Emplacement", type="string", length=500, nullable=false)
     */
    private $emplacement;

    /**
     * @var int
     *@Assert\NotBlank(message = "Le champ 'Num Tel' ne doit pas être vide.")
     *  @Assert\Regex(
     *     pattern="/^[0-9]{8}$/",
     *     message="Le numéro de téléphone doit être composé de 8 chiffres."
     * )
     * @ORM\Column(name="NumTel", type="integer", nullable=false)
     */
    private $numtel;

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

    public function getEmplacement(): ?string
    {
        return $this->emplacement;
    }

    public function setEmplacement(string $emplacement): self
    {
        $this->emplacement = $emplacement;

        return $this;
    }

    public function getNumtel(): ?int
    {
        return $this->numtel;
    }

    public function setNumtel(int $numtel): self
    {
        $this->numtel = $numtel;

        return $this;
    }


}
