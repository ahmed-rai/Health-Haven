<?php
namespace App\Entity;
use App\Validator\Constraints\Consultations;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DossierRepository")
 */
class Dossier
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank(message="Le nom ne peut pas être vide.")
     * @Assert\Length(
     *      min = 2,
     *      max = 255,
     *      minMessage = "Le nom doit contenir au moins {{ limit }} caractères",
     *      maxMessage = "Le nom ne peut pas dépasser {{ limit }} caractères"
     * )
     */
    private $nom;

     /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank(message="Le nom ne peut pas être vide.")
     * @Assert\Length(
     *      max = 255,
     *      maxMessage = "Les médicaments ne peuvent pas dépasser {{ limit }} caractères"
     * )
     */
    private $medicaments;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank(message="Le champ consultations ne peut pas être vide.")
     * @Assert\Length(
     *      max = 255,
     *      maxMessage = "Les consultations ne peuvent pas dépasser {{ limit }} caractères"
     * )
     */
    private $consultations;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank(message="Le champ phobies ne peut pas être vide.")
     * @Assert\Length(
     *      max = 255,
     *      maxMessage = "Les phobies ne peuvent pas dépasser {{ limit }} caractères"
     * )
     */
    private $phobies;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank(message="Le champ résultats ne peut pas être vide.")
     * @Assert\Length(
     *      max = 255,
     *      maxMessage = "Les résultats ne peuvent pas dépasser {{ limit }} caractères"
     * )
     */
    private $resultats;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getMedicaments(): ?string
    {
        return $this->medicaments;
    }

    public function setMedicaments(?string $medicaments): self
    {
        $this->medicaments = $medicaments;

        return $this;
    }

    public function getConsultations(): ?string
    {
        return $this->consultations;
    }

    public function setConsultations(?string $consultations): self
    {
        $this->consultations = $consultations;

        return $this;
    }

    public function getPhobies(): ?string
    {
        return $this->phobies;
    }

    public function setPhobies(?string $phobies): self
    {
        $this->phobies = $phobies;

        return $this;
    }

    public function getResultats(): ?string
    {
        return $this->resultats;
    }

    public function setResultats(?string $resultats): self
    {
        $this->resultats = $resultats;

        return $this;
    }
}


