<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Atm
 *
 * @ORM\Table(name="atm")
 * @ORM\Entity
 */
class Atm
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
     *
     * @ORM\Column(name="Type", type="string", length=500, nullable=false)
     * @Assert\NotBlank(message = "Le champ 'Type' ne doit pas être vide.")
     */
    private $type;

    /**
     * @var \DateTime
     * @Assert\NotBlank(message = "Le champ 'Date' ne doit pas être vide.")
     * @ORM\Column(name="DteTest", type="date", nullable=false)
     */
    private $dtetest;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDtetest(): ?\DateTimeInterface
    {
        return $this->dtetest;
    }

    public function setDtetest(\DateTimeInterface $dtetest): self
    {
        $this->dtetest = $dtetest;

        return $this;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }
}
