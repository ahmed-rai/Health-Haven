<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherAwareInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface 
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
     * @ORM\Column(name="firstname", type="string", length=500, nullable=false)
     */
    private $firstname;

    /**
     * @var string
     *@Assert\NotBlank(message = "Le champ 'Prenom' ne doit pas être vide.")
     * @ORM\Column(name="lastname", type="string", length=500, nullable=false)
     */
    private $lastname;

    /**
     * @var string
     *@Assert\NotBlank(message = "Le champ 'Email' ne doit pas être vide.")
     * @Assert\Email(
     *     message="L'adresse email saisie n'est pas valide."
     * )
     * @ORM\Column(name="Email", type="string", length=500, nullable=false)
     */
    private $email;

    /**
     * @var string
     * @Assert\Length(
     *     min=8,
     *     max=20,
     *     minMessage="Le mot de passe doit comporter au moins {{ limit }} caractères.",
     *     maxMessage="Le mot de passe ne peut pas dépasser {{ limit }} caractères."
     * )
     * @Assert\Regex(
     *     pattern="/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/",
     *     message="Le mot de passe doit contenir au moins une lettre majuscule, une lettre minuscule et un chiffre."
     * )
     * @ORM\Column(name="password", type="string", length=500, nullable=false)
     */
    private $password;

    /**
     * @var int
     *@Assert\Regex(
     *     pattern="/^[0-9]{8}$/",
     *     message="Le numéro de téléphone doit être composé de 8 chiffres."
     * )
     * @ORM\Column(name="Phone", type="integer", nullable=false)
     */
    private $phone;

    /**
     * @var string
     *@Assert\NotBlank(message = "Le champ 'Adresse' ne doit pas être valide.")
     * @ORM\Column(name="Addresse", type="string", length=500, nullable=false)
     */
    private $addresse;

    /**
     * @var string
     *@Assert\NotBlank(message = "Le champ 'Specialite' ne doit pas être vide.")
     * @ORM\Column(name="speciality", type="string", length=500, nullable=false)
     */
    private $speciality;

        /**
     * @ORM\Column(type="json")
     */
    private $roles = [];


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

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
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getPhone(): ?int
    {
        return $this->phone;
    }

    public function setPhone(int $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getAddresse(): ?string
    {
        return $this->addresse;
    }

    public function setAddresse(string $addresse): self
    {
        $this->addresse = $addresse;

        return $this;
    }

    public function getSpeciality(): ?string
    {
        return $this->speciality;
    }

    public function setSpeciality(string $speciality): self
    {
        $this->speciality = $speciality;

        return $this;
    }

    public function eraseCredentials()
{
}
public function getSalt()
{
}


 /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

public function getUsername()
{
}


}
