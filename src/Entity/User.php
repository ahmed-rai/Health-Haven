<?php
// src/Entity/User.php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\Table(name="user")
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", name="idUser")
     */
    private $idUser;

    /**
     * @ORM\Column(type="string", length=250)
     */
    private $Firstname;

    /**
     * @ORM\Column(type="string", length=250)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=250)
     */
    private $Email;

    /**
     * @ORM\Column(type="string", length=250)
     */
    private $mdp;

    /**
     * @ORM\Column(type="integer")
     */
    private $Phone;

    /**
     * @ORM\Column(type="string", length=250)
     */
    private $Addresse;

    /**
     * @ORM\Column(type="string", length=250, nullable=true)
     */
    private $speciality;

    /**
     * @ORM\Column(type="string", length=250)
     */
    private $Role;

    // Getters and setters for each property...

    public function getIdUser(): ?int
    {
        return $this->idUser;
    }

    public function getFirstname(): ?string
    {
        return $this->Firstname;
    }

    public function setFirstname(string $Firstname): self
    {
        $this->Firstname = $Firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(string $Email): self
    {
        $this->Email = $Email;

        return $this;
    }

    public function getMdp(): ?string
    {
        return $this->mdp;
    }

    public function setMdp(string $mdp): self
    {
        $this->mdp = $mdp;

        return $this;
    }

    public function getPhone(): ?int
    {
        return $this->Phone;
    }

    public function setPhone(int $Phone): self
    {
        $this->Phone = $Phone;

        return $this;
    }

    public function getAddresse(): ?string
    {
        return $this->Addresse;
    }

    public function setAddresse(string $Addresse): self
    {
        $this->Addresse = $Addresse;

        return $this;
    }

    public function getSpeciality(): ?string
    {
        return $this->speciality;
    }

    public function setSpeciality(?string $speciality): self
    {
        $this->speciality = $speciality;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->Role;
    }

    public function setRole(string $Role): self
    {
        $this->Role = $Role;

        return $this;
    }
}
