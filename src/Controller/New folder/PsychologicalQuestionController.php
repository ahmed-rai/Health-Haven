<?php
// src/Controller/PsychologicalQuestionController.php

namespace App\Controller;

use App\Entity\PsychologicalQuestion;
use App\Form\PsychologicalQuestionType;
use App\Repository\PsychologicalQuestionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/psychological-question")
 */
class PsychologicalQuestionController extends AbstractController
{
    /**
     * @Route("/", name="psychological_question_index", methods={"GET"})
     */
    public function index(PsychologicalQuestionRepository $psychologicalQuestionRepository): Response
    {
        return $this->render('psychological_question/index.html.twig', [
            'psychological_questions' => $psychologicalQuestionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="psychological_question_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $psychologicalQuestion = new PsychologicalQuestion();
        $form = $this->createForm(PsychologicalQuestionType::class, $psychologicalQuestion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($psychologicalQuestion);
            $entityManager->flush();

            return $this->redirectToRoute('psychological_question_index');
        }

        return $this->render('psychological_question/new.html.twig', [
            'psychological_question' => $psychologicalQuestion,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="psychological_question_show", methods={"GET"})
     */
    public function show(PsychologicalQuestion $psychologicalQuestion): Response
    {
        return $this->render('psychological_question/show.html.twig', [
            'psychological_question' => $psychologicalQuestion,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="psychological_question_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, PsychologicalQuestion $psychologicalQuestion): Response
    {
        $form = $this->createForm(PsychologicalQuestionType::class, $psychologicalQuestion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('psychological_question_index');
        }

        return $this->render('psychological_question/edit.html.twig', [
            'psychological_question' => $psychologicalQuestion,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="psychological_question_delete", methods={"DELETE"})
     */
    public function delete(Request $request, PsychologicalQuestion $psychologicalQuestion): Response
    {
        if ($this->isCsrfTokenValid('delete'.$psychologicalQuestion->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($psychologicalQuestion);
            $entityManager->flush();
        }

        return $this->redirectToRoute('psychological_question_index');
    }
}
