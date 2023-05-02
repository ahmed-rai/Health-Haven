<?php
<<<<<<< HEAD
=======
// src/Entity/User.php
>>>>>>> 9245021fbb87523cb7633316c1f0514e2a867ea5

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
<<<<<<< HEAD
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
=======

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
>>>>>>> 9245021fbb87523cb7633316c1f0514e2a867ea5
     */
    private $lastname;

    /**
<<<<<<< HEAD
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
=======
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
>>>>>>> 9245021fbb87523cb7633316c1f0514e2a867ea5
    }

    public function getFirstname(): ?string
    {
<<<<<<< HEAD
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;
=======
        return $this->Firstname;
    }

    public function setFirstname(string $Firstname): self
    {
        $this->Firstname = $Firstname;
>>>>>>> 9245021fbb87523cb7633316c1f0514e2a867ea5

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
<<<<<<< HEAD
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
=======
        return $this->Email;
    }

    public function setEmail(string $Email): self
    {
        $this->Email = $Email;
>>>>>>> 9245021fbb87523cb7633316c1f0514e2a867ea5

        return $this;
    }

<<<<<<< HEAD
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;
=======
    public function getMdp(): ?string
    {
        return $this->mdp;
    }

    public function setMdp(string $mdp): self
    {
        $this->mdp = $mdp;
>>>>>>> 9245021fbb87523cb7633316c1f0514e2a867ea5

        return $this;
    }

    public function getPhone(): ?int
    {
<<<<<<< HEAD
        return $this->phone;
    }

    public function setPhone(int $phone): self
    {
        $this->phone = $phone;
=======
        return $this->Phone;
    }

    public function setPhone(int $Phone): self
    {
        $this->Phone = $Phone;
>>>>>>> 9245021fbb87523cb7633316c1f0514e2a867ea5

        return $this;
    }

    public function getAddresse(): ?string
    {
<<<<<<< HEAD
        return $this->addresse;
    }

    public function setAddresse(string $addresse): self
    {
        $this->addresse = $addresse;
=======
        return $this->Addresse;
    }

    public function setAddresse(string $Addresse): self
    {
        $this->Addresse = $Addresse;
>>>>>>> 9245021fbb87523cb7633316c1f0514e2a867ea5

        return $this;
    }

    public function getSpeciality(): ?string
    {
        return $this->speciality;
    }

<<<<<<< HEAD
    public function setSpeciality(string $speciality): self
=======
    public function setSpeciality(?string $speciality): self
>>>>>>> 9245021fbb87523cb7633316c1f0514e2a867ea5
    {
        $this->speciality = $speciality;

        return $this;
    }

<<<<<<< HEAD
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


=======
    public function getRole(): ?string
    {
        return $this->Role;
    }

    public function setRole(string $Role): self
    {
        $this->Role = $Role;

        return $this;
    }
>>>>>>> 9245021fbb87523cb7633316c1f0514e2a867ea5
}
