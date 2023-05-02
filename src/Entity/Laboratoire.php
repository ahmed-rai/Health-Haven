<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Laboratoire
 *
 * @ORM\Table(name="laboratoire")
 * @ORM\Entity
 */
class Laboratoire
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

   /**
 * @var string
 *
 * @Assert\NotBlank(message="Le champ 'Nom' ne doit pas être vide.")
 * @Assert\Type(type="string", message="Le champ 'Nom' doit être une chaîne de caractères.")
 * @ORM\Column(name="Nom", type="string", length=500, nullable=false)
 */
private $nom;


    /**
     * @var float
     *
     * @Assert\NotBlank(message = "Le champ 'Latitude' ne doit pas être vide.")
     * @Assert\Type(type="float", message="Le champ 'Latitude' doit être un nombre décimal (ex. 36.8065).")
     * @Assert\Range(min=31.00, max=37.00, minMessage="Le champ 'Latitude' doit être compris entre 31.00 et 37.00.", maxMessage="Le champ 'Latitude' doit être compris entre 31.00 et 37.00.")
     * @ORM\Column(name="Latitude", type="float", nullable=false)
     */
    private $latitude;

    /**
     * @var float
     *
     * @Assert\NotBlank(message = "Le champ 'Longitude' ne doit pas être vide.")
     * @Assert\Type(type="float", message="Le champ 'Longitude' doit être un nombre décimal (ex. 10.1815).")
     * @Assert\Range(min=8.50, max=11.00, minMessage="Le champ 'Longitude' doit être compris entre 8.50 et 11.00.", maxMessage="Le champ 'Longitude' doit être compris entre 8.50 et 11.00.")
     * @ORM\Column(name="Longitude", type="float", nullable=false)
     */
    private $longitude;

    

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

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }
}

   
