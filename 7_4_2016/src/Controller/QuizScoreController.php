<?php
// src/Controller/QuizScoreController.php

namespace App\Controller;

use App\Repository\QuizRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuizScoreController extends AbstractController
{
    /**
     * @Route("/quiz/score", name="calculate_quiz_score", methods={"POST"})
     */
    public function calculate(Request $request, QuizRepository $quizRepository): Response
    {
        $data = json_decode($request->getContent(), true);
        $quizId = $data['quizId'];
        $answers = $data['answers'];
    
        // Fetch the quiz and questions from the database
        $quiz = $quizRepository->find($quizId);
        $questions = $quiz->getQuestions();
    
        // Calculate the score
        $score = 0;
        foreach ($questions as $index => $question) {
            if (isset($answers[$index]) && $question->isCorrectAnswer($answers[$index])) {
                $score += $question->getScoreForAnswer($answers[$index]);
            }
        }
    
        // Return a JSON response with the score
        return new JsonResponse(['score' => $score]);
    }
    
}
