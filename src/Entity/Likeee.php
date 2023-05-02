<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use App\Repository\LikeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LikeRepository::class )]
class Likeee
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name:"Id",nullable: false)]
    private ?int $id;


    #[ORM\Column(length: 255,nullable: false)]
    private ?string $nom;


    #[ORM\Column(name:"conseil",nullable: false)]
    private ?int $conseil;

 


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

    public function getConseil(): ?int
    {
        return $this->conseil;
    }

    public function setConseil(int $conseil): self
    {
        $this->conseil = $conseil;

        return $this;
    }





}
