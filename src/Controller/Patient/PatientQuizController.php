<?php

namespace App\Controller\Patient;

use App\Entity\Quiz;
use App\Repository\QuizRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/patient_quiz')]
class PatientQuizController extends AbstractController
{

    /*
    #[Route('/', name: 'patient_quiz_index', methods: ['GET'])]
    public function index(QuizRepository $quizRepository): Response
    {
        $quizzes = $quizRepository->findBy(['Approuvé' => true]);
        return $this->render('quiz_selection/index.html.twig', [
            'quizzes' => $quizRepository->findApproved(),
        ]);
    }  -->
 */
    #[Route('/', name: 'patient_quiz_index', methods: ['GET'])]
    public function index(QuizRepository $quizRepository): Response
    {
        $quizzes = $quizRepository->findApproved();
        return $this->render('quiz_selection/index.html.twig', [
            'quizzes' => $quizzes,
        ]);
    }
    
    
   

    #[Route('/{id}', name: 'patient_quiz_show', methods: ['GET'])]
    public function show(Quiz $quiz): Response
    {
        return $this->render('patient_quiz/show.html.twig', [
            'quiz' => $quiz,
        ]);
    } 

    /*
    #[Route('/quiz/result/{id}', name: 'app_quiz_result', methods: ['POST'])]
    public function result(int $id, QuizRepository $quizRepository, Request $request, EntityManagerInterface $entityManager): Response
    {
        $quiz = $quizRepository->find($id);
    
        if (!$quiz) {
            throw $this->createNotFoundException('Quiz not found');
        }
    
        // Retrieve the user's previous quiz result
        $user = $this->getUser();
        $previousResult = $entityManager->getRepository(QuizResult::class)->findOneBy([
            'quiz' => $quiz,
            'user' => $user,
        ]);
    
        // Calculate the user's current score
        $score = 0;
        $maxScore = 0;
        foreach ($quiz->getTests() as $test) {
            $answerKey = 'answer_'.$test->getId();
            if ($request->request->has($answerKey)) {
                $answer = $request->request->get($answerKey);
                $score += $answer;
                $maxScore += $test->getMaxScore();
            }
        }
    
        // Calculate the quiz threshold
        $threshold = $maxScore * $quiz->getThresholdPercent() / 100;
    
        // Save the user's quiz result
        $quizResult = new QuizResult();
        $quizResult->setQuiz($quiz);
        $quizResult->setUser($user);
        $quizResult->setScore($score);
        $quizResult->setMaxScore($maxScore);
        $entityManager->persist($quizResult);
        $entityManager->flush();
    
        // Set the result message based on the user's score
        if ($score >= $threshold) {
            $resultMessage = "Based on your score, you may be experiencing some issues. We recommend you to consult a professional.";
        } else {
            $resultMessage = "Based on your score, you seem to be doing well. Keep up the good work!";
        }
    
        return $this->render('patient_quiz/result.html.twig', [
            'quiz' => $quiz,
            'previous_score' => $previousResult ? $previousResult->getScore() : null,
            'previous_result_message' => $previousResult ? $previousResult->getResultMessage() : null,
            'score' => $score,
            'max_score' => $maxScore,
            'threshold' => $threshold,
            'result_message' => $resultMessage,
        ]);
    }
    
    */
    #[Route('/result/{id}', name: 'app_quiz_result', methods: ['GET', 'POST'])]
public function result(int $id, QuizRepository $quizRepository): Response
{
    $quiz = $quizRepository->find($id);

    if (!$quiz) {
        throw $this->createNotFoundException('Quiz not found');
    }

    // Replace with your logic to calculate the score, etc.
    $resultMessages = [
        "Votre situation n'est pas si grave, mais vous pouvez consulter un de nos psy.",
        "Vous semblez être en bonne santé mentale. Continuez sur cette voie!",
        "Il est possible que vous ayez besoin d'une aide professionnelle. N'hésitez pas à nous contacter pour plus d'informations."
    ];

    $resultMessage = $resultMessages[array_rand($resultMessages)];

    return $this->render('quiz/result.html.twig', [
        'quiz' => $quiz,
        'result_message' => $resultMessage,
    ]);
}

}
