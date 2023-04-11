<?php

namespace App\Controller;

use App\Entity\Test;
use App\Form\TestType;
use App\Repository\TestRepository;
use App\Repository\QuizRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/test")
 */
class TestController extends AbstractController
{
    /**
     * @Route("/", name="app_test_index", methods={"GET"})
     */
    public function index(TestRepository $testRepository): Response
    {
        return $this->render('test/index.html.twig', [
            'tests' => $testRepository->findAllWithQuiz(),
        ]);
    }

    /**
     * @Route("/new", name="app_test_new", methods={"GET","POST"})
     */
    public function new(Request $request, QuizRepository $quizRepository): Response
    {
        $test = new Test();
        $form = $this->createForm(TestType::class, $test);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($test);
            $entityManager->flush();

            return $this->redirectToRoute('app_test_index');
        }

        $quizzes = $quizRepository->findAll();

        return $this->render('test/new.html.twig', [
            'test' => $test,
            'form' => $form->createView(),
            'quizzes' => $quizzes,
        ]);
    }

   /**
 * @Route("/{id}", name="app_test_show", methods={"GET"})
 */
public function show(Test $test): Response
{
    return $this->render('test/show.html.twig', [
        'test' => $test,
    ]);
}

/**
 * @Route("/{id}/edit", name="app_test_edit", methods={"GET","POST"})
 */
public function edit(Request $request, Test $test, QuizRepository $quizRepository): Response
{
    $form = $this->createForm(TestType::class, $test);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $this->getDoctrine()->getManager()->flush();

        return $this->redirectToRoute('app_test_index');
    }

    $quizzes = $quizRepository->findAll();

    return $this->render('test/edit.html.twig', [
        'test' => $test,
        'form' => $form->createView(),
        'quizzes' => $quizzes,
    ]);
}

/**
 * @Route("/{id}", name="app_test_delete", methods={"POST"})
 */
public function delete(Request $request, Test $test): Response
{
    if ($this->isCsrfTokenValid('delete'.$test->getId(), $request->request->get('_token'))) {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($test);
        $entityManager->flush();
    }

    return $this->redirectToRoute('app_test_index');
}
}
