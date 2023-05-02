<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Produitspara
 *
 * @ORM\Table(name="produitspara", indexes={@ORM\Index(name="fk_pra_prod", columns={"idPara"})})
 * @ORM\Entity
 */
class Produitspara
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
     * @ORM\Column(name="nom", type="string", length=500, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *@Assert\NotBlank(message = "Le champ 'Rreference' ne doit pas être vide.")
     * @ORM\Column(name="reference", type="string", length=500, nullable=false)
     */
    private $reference;

    /**
     * @var string
     *@Assert\NotBlank(message = "Le champ 'Categorie' ne doit pas être vide.")
     * @ORM\Column(name="categorie", type="string", length=500, nullable=false)
     */
    private $categorie;

    /**
     * @var string
     *@Assert\NotBlank(message = "Le champ 'Description' ne doit pas être vide.")
     * @ORM\Column(name="description", type="string", length=500, nullable=false)
     */
    private $description;

    /**
     * @var string
     *@Assert\NotBlank(message = "Le champ 'Disponibilite' ne doit pas être vide.")
     * @ORM\Column(name="disponibilite", type="string", length=500, nullable=false)
     */
    private $disponibilite;



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

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getCategorie(): ?string
    {
        return $this->categorie;
    }

    public function setCategorie(string $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

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



}
