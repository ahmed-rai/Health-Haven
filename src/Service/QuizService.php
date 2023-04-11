<?php

namespace App\Service;

use App\Entity\Quiz;
use Doctrine\ORM\EntityManagerInterface;

class QuizService
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Get all quizzes.
     *
     * @return Quiz[]|null
     */
    public function getAllQuizzes(): ?array
    {
        $repository = $this->entityManager->getRepository(Quiz::class);

        return $repository->findAll();
    }

    /**
     * Approve a quiz.
     *
     * @param Quiz $quiz
     */
    public function approveQuiz(Quiz $quiz): void
    {
        $quiz->setIsApproved(true);

        $this->entityManager->persist($quiz);
        $this->entityManager->flush();
    }
}
