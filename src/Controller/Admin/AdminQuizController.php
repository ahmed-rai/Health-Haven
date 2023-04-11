<?php

namespace App\Controller\Admin;

use App\Entity\Quiz;
use App\Repository\QuizRepository;
use App\Repository\TestRepository;
use App\Entity\Test;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin", name="admin_quiz_")
 */
class AdminQuizController extends AbstractController
{
    private $quizRepository;

    public function __construct(QuizRepository $quizRepository)
    {
        $this->quizRepository = $quizRepository;
    }

    /**
     * @Route("/", name="index", methods={"GET"})
     */
    public function index(): Response
    {
        $quizzes = $this->quizRepository->findAll();

        return $this->render('admin/index.html.twig', [
            'quizzes' => $quizzes,
        ]);
    }

    /**
     * @Route("/admin/approve/{id}", name="approve", methods={"GET", "POST"})
     */
    public function approveQuiz(Request $request, Quiz $quiz): Response
    {
        if ($this->isCsrfTokenValid('approve'.$quiz->getId(), $request->request->get('_token'))) {
            $quiz->setIsApproved(true);
            $this->quizRepository->save($quiz, true);
            $this->addFlash('success', 'Quiz approved successfully.');
        }

        return $this->redirectToRoute('admin_quiz_index');
    }
/**
 * @Route("/disapprove/{id}", name="disapprove", methods={"GET", "POST"})
 */
public function disapproveQuiz(Request $request, Quiz $quiz): Response
{
    if ($this->isCsrfTokenValid('disapprove'.$quiz->getId(), $request->request->get('_token'))) {
        $quiz->setIsApproved(false);
        $this->quizRepository->save($quiz, true);
        $this->addFlash('warning', 'Quiz disapproved successfully.');
    }

    return $this->redirectToRoute('admin_quiz_index');
}


    /**
     * @Route("/dashboard", name="admin_dashboard", methods={"GET"})
     */
    public function dashboard(): Response
    {
        return $this->render('admin/index.html.twig');
    }


 /**
     * @Route("/testa", name="admin_test", methods={"GET"})
     */
    public function test(TestRepository $testRepository): Response
    {
        $tests = $testRepository->findAll();

        return $this->render('admin/test.html.twig', [
            'tests' => $tests,
        ]);
    }
    
}
