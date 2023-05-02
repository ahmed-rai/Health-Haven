<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Prescription
 *
 * @ORM\Table(name="prescription", indexes={@ORM\Index(name="fk_user", columns={"idUser"})})
 * @ORM\Entity
 */
class Prescription
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
     * @var int
     *
     * @ORM\Column(name="dosage", type="integer", nullable=false)
     *  @Assert\Range(
     *      min = 0,
     *      max = 100000,
     *      notInRangeMessage = "Le dosage doit être compris entre {{ min }} et {{ max }}.",
     *      invalidMessage = "Le dosage doit être un nombre."
     * )
     */
    private $dosage;

    /**
     * @var string

     * @ORM\Column(name="signature", type="string", length=500, nullable=false)
     */
    private $signature;

    /**
     * @var string
     * @ORM\Column(name="iduser", type="string", length=500, nullable=false)

     */
    private $iduser;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_med", type="string", length=500, nullable=false)
     */
    private $nomMed;

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getDosage(): ?int
    {
        return $this->dosage;
    }

    public function setDosage(int $dosage): self
    {
        $this->dosage = $dosage;

        return $this;
    }

    public function getSignature(): ?string
    {
        return $this->signature;
    }

    public function setSignature(string $signature): self
    {
        $this->signature = $signature;

        return $this;
    }

    public function getIduser(): ?string
    {
        return $this->iduser;
    }

    public function setIduser(string $iduser): self
    {
        $this->iduser = $iduser;

        return $this;
    }

    public function getNomMed(): ?string
    {
        return $this->nomMed;
    }

    public function setNomMed(string $nomMed): self
    {
        $this->nomMed = $nomMed;

        return $this;
    }


}
