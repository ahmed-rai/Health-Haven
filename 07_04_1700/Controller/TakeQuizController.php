<?php
// src/Controller/TakeQuizController.php
namespace App\Controller;

use App\Entity\Test;
use App\Repository\QuizRepository;
use App\Repository\TestRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TakeQuizController extends AbstractController
{
    /**
     * @Route("/take_quiz/{id}", name="take_quiz", methods={"GET","POST"})
     */
    public function takeQuiz(Request $request, QuizRepository $quizRepository, TestRepository $testRepository, int $id): Response
    {
        $quiz = $quizRepository->find($id);

        if (!$quiz) {
            throw $this->createNotFoundException('Quiz not found.');
        }

        $tests = $testRepository->findBy(['quiz' => $quiz]);

        return $this->render('take_quiz/index.html.twig', [
            'quiz' => $quiz,
            'tests' => $tests,
        ]);
    }
}
