<?php

namespace App\Entity;

use App\Repository\AppointmentRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AppointmentRepository::class)
 */
class Appointment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $idap;

    /**
     * @ORM\Column(type="date")
     */
    private \DateTimeInterface $dateap;

    /**
     * @ORM\Column(type="string", length=5)
     */
    private string $hour;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $status=false;

    /**
     * @ORM\ManyToOne(targetEntity=Utilisateur::class)
     * @ORM\JoinColumn(name="idMedecin", referencedColumnName="iduser")
     */
    private ?Utilisateur $idmedecin;

    /**
     * @ORM\ManyToOne(targetEntity=Utilisateur::class)
     * @ORM\JoinColumn(name="idPatient", referencedColumnName="iduser")
     */
    private ?Utilisateur $idpatient;

    public function getIdap(): int
    {
        return $this->idap;
    }

    public function getDateap(): \DateTimeInterface
    {
        return $this->dateap;
    }

    public function setDateap(\DateTimeInterface $dateap): self
    {
        $this->dateap = $dateap;
        return $this;
    }

    public function getHour(): string
    {
        return $this->hour;
    }

    public function setHour(string $hour): self
    {
        $this->hour = $hour;
        return $this;
    }

    public function isStatus(): bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;
        return $this;
    }

    public function getIdmedecin(): ?Utilisateur
    {
        return $this->idmedecin;
    }

    public function setIdmedecin(?Utilisateur $idmedecin): self
    {
        $this->idmedecin = $idmedecin;
        return $this;
    }

    public function getIdpatient(): ?Utilisateur
    {
        return $this->idpatient;
    }

    public function setIdpatient(?Utilisateur $idpatient): self
    {
        $this->idpatient = $idpatient;
        return $this;
    }

    public function getIdmedecinId(): ?int
{
    return $this->idmedecin ? $this->idmedecin->getIduser() : null;
}

public function getIdpatientId(): ?int
{
    return $this->idpatient ? $this->idpatient->getIduser() : null;
}

public function getMedecinName(): ?string
{
    return $this->idmedecin ? $this->idmedecin->getFirstname() . ' ' . $this->idmedecin->getLastname() : null;
}
public function getPatientName(): ?string
{
    return $this->idpatient ? $this->idpatient->getFirstname() . ' ' . $this->idpatient->getLastname() : null;
}
   

}
