<?php

namespace App\Controller\Psy;

use App\Entity\Quiz;
use App\Entity\Test;
use App\Form\QuizType;
use App\Form\TestType;
use App\Repository\QuizRepository;
use App\Repository\TestRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/psy/quiz')]
class PsyQuizController extends AbstractController
{
    #[Route('/', name: 'psy_quiz_index', methods: ['GET'])]
    public function index(QuizRepository $quizRepository): Response
    {
        return $this->render('psy/quiz/index.html.twig', [
            'quizzes' => $quizRepository->findByPsy($this->getUser()),
        ]);
    }

    #[Route('/new', name: 'psy_quiz_new', methods: ['GET', 'POST'])]
    public function new(Request $request, QuizRepository $quizRepository): Response
    {
        $quiz = new Quiz();
        $form = $this->createForm(QuizType::class, $quiz);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $quiz->setPsy($this->getUser());
            $quizRepository->save($quiz, true);

            return $this->redirectToRoute('psy_quiz_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('psy/quiz/new.html.twig', [
            'quiz' => $quiz,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'psy_quiz_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Quiz $quiz, QuizRepository $quizRepository): Response
    {
        $form = $this->createForm(QuizType::class, $quiz);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $quizRepository->save($quiz, true);

            return $this->redirectToRoute('psy_quiz_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('psy/quiz/edit.html.twig', [
            'quiz' => $quiz,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_quiz_delete', methods: ['POST'])]
    public function delete(Request $request, Quiz $quiz, QuizRepository $quizRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $quiz->getId(), $request->request->get('_token'))) {
            $quizRepository->delete($quiz, true);
        }

        return $this->redirectToRoute('psy_quiz_index', [], Response::HTTP_SEE_OTHER);
    }
    // Add other methods for handling tests within quizzes, such as creating, editing, and deleting tests.
}
