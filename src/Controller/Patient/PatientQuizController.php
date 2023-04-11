<?php

namespace App\Controller\Patient;

use App\Entity\Quiz;
use App\Repository\QuizRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/patient/quiz')]
class PatientQuizController extends AbstractController
{
    #[Route('/', name: 'patient_quiz_index', methods: ['GET'])]
    public function index(QuizRepository $quizRepository): Response
    {
        return $this->render('patient_quiz/index.html.twig', [
            'quizzes' => $quizRepository->findApproved(),
        ]);
    }

    #[Route('/{id}', name: 'patient_quiz_show', methods: ['GET'])]
    public function show(Quiz $quiz): Response
    {
        return $this->render('patient_quiz/show.html.twig', [
            'quiz' => $quiz,
        ]);
    }

    #[Route('/result/{id}', name: 'patient_quiz_result', methods: ['GET', 'POST'])]
    public function result(int $id, QuizRepository $quizRepository): Response
    {
        $quiz = $quizRepository->find($id);

        if (!$quiz) {
            throw $this->createNotFoundException('Quiz not found');
        }

        // Replace with your logic to calculate the score, etc.
        $resultMessage = "Votre situation n'est pas si grave, mais vous pouvez consulter un de nos psy.";

        return $this->render('patient_quiz/result.html.twig', [
            'quiz' => $quiz,
            'result_message' => $resultMessage,
        ]);
    }
}
