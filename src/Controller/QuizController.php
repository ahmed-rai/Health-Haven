<?php

namespace App\Controller;

use App\Entity\Quiz;
use App\Form\QuizType;
use App\Repository\QuizRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/quiz')]
class QuizController extends AbstractController
{
    #[Route('/', name: 'app_quiz_index', methods: ['GET'])]
    public function index(QuizRepository $quizRepository): Response
    {
        return $this->render('quiz/index.html.twig', [
            'quizzes' => $quizRepository->findAll(),
        ]);
    }

<<<<<<< HEAD

 /**
     * @Route("/api/quizzes", name="api_quizzes", methods={"GET"})
     */
    public function apiQuizzes(QuizRepository $quizRepository, SerializerInterface $serializer): JsonResponse
    {
        $quizzes = $quizRepository->findAll();
        $data = $serializer->normalize($quizzes, 'json', ['groups' => 'quiz']);
        $json = $serializer->encode($data, 'json');
        
        return new JsonResponse($json, 200, [], true);
    }

=======
>>>>>>> 9245021fbb87523cb7633316c1f0514e2a867ea5
    #[Route('/new', name: 'app_quiz_new', methods: ['GET', 'POST'])]
    public function new(Request $request, QuizRepository $quizRepository): Response
    {
        $quiz = new Quiz();
        $form = $this->createForm(QuizType::class, $quiz);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $quizRepository->save($quiz, true);

            return $this->redirectToRoute('app_quiz_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('quiz/new.html.twig', [
            'quiz' => $quiz,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_quiz_show', methods: ['GET'])]
    public function show(Quiz $quiz): Response
    {
        return $this->render('quiz/show.html.twig', [
            'quiz' => $quiz,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_quiz_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Quiz $quiz, QuizRepository $quizRepository): Response
    {
        $form = $this->createForm(QuizType::class, $quiz);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $quizRepository->save($quiz, true);

            return $this->redirectToRoute('app_quiz_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('quiz/edit.html.twig', [
            'quiz' => $quiz,
            'form' => $form,
        ]);
    }

    /**
 * @Route("/quiz/search", name="app_quiz_search")
 */
public function search(Request $request): Response
{
    $query = $request->query->get('q', '');

    $quizzes = $this->getDoctrine()
        ->getRepository(Quiz::class)
        ->search($query);

    return $this->render('quiz/index.html.twig', [
        'quizzes' => $quizzes,
    ]);
}

    #[Route('/{id}', name: 'app_quiz_delete', methods: ['POST'])]
    public function delete(Request $request, Quiz $quiz, QuizRepository $quizRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$quiz->getId(), $request->request->get('_token'))) {
            $quizRepository->remove($quiz, true);
        }

        return $this->redirectToRoute('app_quiz_index', [], Response::HTTP_SEE_OTHER);
    }
     
    #[Route('/result/{id}', name: 'app_quiz_result', methods: ['GET', 'POST'])]
public function result(int $id, QuizRepository $quizRepository): Response
{
    $quiz = $quizRepository->find($id);

    if (!$quiz) {
        throw $this->createNotFoundException('Quiz not found');
    }

    // Random messages in French for demonstration purposes
    $resultMessages = [
        "Félicitations! Vous avez obtenu un score parfait!",
        "Votre score est assez élevé. Nous vous recommandons de consulter un professionnel de la santé mentale si vous avez besoin d'aide.",
        "Votre score est moyen. Vous pouvez peut-être bénéficier de quelques changements de style de vie pour améliorer votre bien-être mental.",
        "Votre score est bas. Nous vous recommandons de prendre des mesures pour améliorer votre santé mentale, comme faire de l'exercice régulièrement et parler à un ami ou un professionnel de la santé mentale.",
        "Votre score est très bas. Nous vous recommandons de chercher de l'aide professionnelle dès que possible."
    ];

    // Choose a random message from the array
    $resultMessage = $resultMessages[array_rand($resultMessages)];

    return $this->render('quiz/result.html.twig', [
        'quiz' => $quiz,
        'result_message' => $resultMessage,
    ]);
}

}
