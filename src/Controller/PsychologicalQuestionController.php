<?php

namespace App\Controller;

use App\Entity\PsychologicalQuestion;
use App\Form\PsychologicalQuestion1Type;
use App\Repository\PsychologicalQuestionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/psychological/question')]
class PsychologicalQuestionController extends AbstractController
{
    #[Route('/', name: 'app_psychological_question_index', methods: ['GET'])]
    public function index(PsychologicalQuestionRepository $psychologicalQuestionRepository): Response
    {
        return $this->render('psychological_question/index.html.twig', [
            'psychological_questions' => $psychologicalQuestionRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_psychological_question_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PsychologicalQuestionRepository $psychologicalQuestionRepository): Response
    {
        $psychologicalQuestion = new PsychologicalQuestion();
        $form = $this->createForm(PsychologicalQuestion1Type::class, $psychologicalQuestion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $psychologicalQuestionRepository->save($psychologicalQuestion, true);

            return $this->redirectToRoute('app_psychological_question_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('psychological_question/new.html.twig', [
            'psychological_question' => $psychologicalQuestion,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_psychological_question_show', methods: ['GET'])]
    public function show(PsychologicalQuestion $psychologicalQuestion): Response
    {
        return $this->render('psychological_question/show.html.twig', [
            'psychological_question' => $psychologicalQuestion,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_psychological_question_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, PsychologicalQuestion $psychologicalQuestion, PsychologicalQuestionRepository $psychologicalQuestionRepository): Response
    {
        $form = $this->createForm(PsychologicalQuestion1Type::class, $psychologicalQuestion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $psychologicalQuestionRepository->save($psychologicalQuestion, true);

            return $this->redirectToRoute('app_psychological_question_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('psychological_question/edit.html.twig', [
            'psychological_question' => $psychologicalQuestion,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_psychological_question_delete', methods: ['POST'])]
    public function delete(Request $request, PsychologicalQuestion $psychologicalQuestion, PsychologicalQuestionRepository $psychologicalQuestionRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$psychologicalQuestion->getId(), $request->request->get('_token'))) {
            $psychologicalQuestionRepository->remove($psychologicalQuestion, true);
        }

        return $this->redirectToRoute('app_psychological_question_index', [], Response::HTTP_SEE_OTHER);
    }
}
