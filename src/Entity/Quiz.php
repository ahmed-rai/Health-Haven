<?php
// src/Entity/Quiz.php
// src/Entity/Quiz.php

namespace App\Entity;

use App\Repository\QuizRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\QuizRepository")
 */
class Quiz
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Test", mappedBy="quiz", orphanRemoval=true, cascade={"persist"})
     */
    private $tests;
    // ...
/**
 * @ORM\Column(type="boolean")
 */
private $isApproved = false;
 


    public function __construct()
    {
        $this->tests = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }
   
public function getIsApproved(): ?bool
{
    return $this->isApproved;
}

public function setIsApproved(bool $isApproved): self
{
    $this->isApproved = $isApproved;

    return $this;
}

    /**
     * @return Collection|Test[]
     */
    public function getTests(): Collection
    {
        return $this->tests;
    }

    public function addTest(Test $test): self
    {
        if (!$this->tests->contains($test)) {
            $this->tests[] = $test;
            $test->setQuiz($this);
        }

        return $this;
    }
  
    
    // ...
    
    public function score(Request $request, QuizRepository $quizRepository)
    {
        $quizId = $request->query->get('id');
        $quiz = $quizRepository->find($quizId);
    
        if (!$quiz) {
            throw $this->createNotFoundException('No quiz found for id ' . $quizId);
        }
    
        // Calculate the score, max_score, and threshold here
    
        return $this->render('quiz/score.html.twig', [
            'quiz' => $quiz,
            'score' => $score,
            'max_score' => $max_score,
            'threshold' => $threshold,
        ]);
    }
    public function removeTest(Test $test): self
    {
        if ($this->tests->contains($test)) {
            $this->tests->removeElement($test);
            // set the owning side to null (unless already changed)
            if ($test->getQuiz() === $this) {
                $test->setQuiz(null);
            }
        }

        return $this;
    }
}
