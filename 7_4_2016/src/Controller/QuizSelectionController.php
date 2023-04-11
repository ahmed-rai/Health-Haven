<?php
// src/Controller/QuizSelectionController.php
namespace App\Controller;

use App\Repository\QuizRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuizSelectionController extends AbstractController
{
    /**
     * @Route("/quiz_selection", name="quiz_selection")
     */
    public function index(QuizRepository $quizRepository): Response
    {
        $quizzes = $quizRepository->findAll();

        return $this->render('quiz_selection/index.html.twig', [
            'quizzes' => $quizzes,
        ]);
    }
}
