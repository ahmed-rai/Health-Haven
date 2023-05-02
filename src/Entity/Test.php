<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\TestRepository")
 */
class Test
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="Le champ question ne peut pas être vide.")
     */
    private $question;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="Le champ answer1 ne peut pas être vide.")
     */
    private $answer1;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Le champ score1 ne peut pas être vide.")
     * @Assert\Type(type="integer", message="Le score1 doit être un nombre.")
     */
    private $score1;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="Le champ answer2 ne peut pas être vide.")
     */
    private $answer2;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Le champ score2 ne peut pas être vide.")
     * @Assert\Type(type="integer", message="Le score2 doit être un nombre.")
     */
    private $score2;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="Le champ answer3 ne peut pas être vide.")
     */
    private $answer3;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Le champ score3 ne peut pas être vide.")
     * @Assert\Type(type="integer", message="Le score3 doit être un nombre.")
     */
    private $score3;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="Le champ answer4 ne peut pas être vide.")
     */
    private $answer4;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Le champ score4 ne peut pas être vide.")
     * @Assert\Type(type="integer", message="Le score4 doit être un nombre.")
     */
    private $score4;

    /**
     * @ORM\ManyToOne(targetEntity=Quiz::class, inversedBy="tests")
     * @ORM\JoinColumn(nullable=false)
     */
    private $quiz;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestion(): ?string
    {
        return $this->question;
    }

    public function setQuestion(string $question): self
    {
        $this->question = $question;

        return $this;
    }

    public function getAnswer1(): ?string
    {
        return $this->answer1;
    }

    public function setAnswer1(string $answer1): self
    {
        $this->answer1 = $answer1;

        return $this;
    }

    public function getScore1(): ?int
    {
        return $this->score1;
    }

    public function setScore1(int $score1): self
    {
        $this->score1 = $score1;

        return $this;
    }

    public function getAnswer2(): ?string
    {
        return $this->answer2;
    }

    public function setAnswer2(string $answer2): self
    {
        $this->answer2 = $answer2;

        return $this;
    }

    public function getScore2(): ?int
    {
        return $this->score2;
    }

    public function setScore2(int $score2): self
    {
        $this->score2 = $score2;

        return $this;
    }

    public function getAnswer3(): ?string
    {
        return $this->answer3;
    }

    public function setAnswer3(string $answer3): self
    {
        $this->answer3 = $answer3;

        return $this;
    }

    public function getScore3(): ?int
    {
        return $this->score3;
    }

    public function setScore3(int $score3): self
    {
        $this->score3 = $score3;

        return $this;
    }

    public function getAnswer4(): ?string
    {
        return $this->answer4;
    }

    public function setAnswer4(string $answer4): self
    {
        $this->answer4 = $answer4;

        return $this;
    }

    public function getScore4(): ?int
    {
        return $this->score4;
    }

    public function setScore4(int $score4): self
    {
        $this->score4 = $score4;

        return $this;
    }
    

    public function getQuiz(): ?Quiz
    {
        return $this->quiz;
    }

    public function setQuiz(?Quiz $quiz): self
    {
        $this->quiz = $quiz;

        return $this;
    }
    
 
    

}
