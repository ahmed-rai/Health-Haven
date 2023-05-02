<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Results
 *
 * @ORM\Table(name="results", indexes={@ORM\Index(name="refTest", columns={"refTest"})})
 * @ORM\Entity
 */
class Results
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_rslt", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idRslt;

    /**
     * @var string
     *@Assert\NotBlank(message = "Le champ 'Resultat' ne doit pas être vide.")
     * @ORM\Column(name="rsltTest", type="string", length=500, nullable=false)
     */
    private $rslttest;
    /**
     * @var \DateTime
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;

    /**
     * @var string
     * @ORM\Column(name="refTest", type="string", length=500, nullable=false)
     *
     */
    private $reftest;



    public function getIdRslt(): ?int
    {
        return $this->idRslt;
    }

    public function getRslttest(): ?string
    {
        return $this->rslttest;
    }

    public function setRslttest(string $rslttest): self
    {
        $this->rslttest = $rslttest;

        return $this;
    }
    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }



    public function getReftest(): ?string
    {
        return $this->reftest;
    }

    public function setReftest(string $reftest): self
    {
        $this->reftest = $reftest;

        return $this;
    }


}
