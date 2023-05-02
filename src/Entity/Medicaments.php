<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Medicaments
 *
 * @ORM\Table(name="medicaments")
 * @ORM\Entity
 */
class Medicaments
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
    *@ORM\Column(name="dci", type="string", length=500, nullable=false)
     */
    private $dci;

    /**
     * @var string
     *@Assert\NotBlank(message = "Le champ 'Disponibilite' ne doit pas être vide.")
     * @ORM\Column(name="disponibilite", type="string", length=500, nullable=false)
     */
    private $disponibilite;

    /**
     * @var float
     *@Assert\NotBlank(message = "Le champ 'prix' ne doit pas être vide.")
     * @Assert\Range(
     *      min = 0,
     *      max = 100000,
     *      notInRangeMessage = "Le prix doit être compris entre {{ min }} et {{ max }}.",
     *      invalidMessage = "Le prix doit être un nombre."
     * )
     * @ORM\Column(name="prix", type="float", precision=10, scale=0, nullable=false)
     */
    private $prix;

    public function getid(): ?int
    {
        return $this->id;
    }
    public function getDci(): ?string
    {
        return $this->dci;
    }

    public function setDci(string $dci): self
    {
        $this->dci = $dci;

        return $this;
    }

    public function getDisponibilite(): ?string
    {
        return $this->disponibilite;
    }

    public function setDisponibilite(string $disponibilite): self
    {
        $this->disponibilite = $disponibilite;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }


}
