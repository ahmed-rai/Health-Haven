<?php

namespace App\Controller\Admin;

use App\Service\TwilioSmsSender;
use App\Entity\Quiz;
use App\Repository\QuizRepository;
use App\Repository\TestRepository;
use App\Entity\Test;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Service\NotificationServer;

/**
 * @Route("/admin", name="admin_quiz_")
 */
class AdminQuizController extends AbstractController
{
  
    private $quizRepository;
    private $notificationServer;
<<<<<<< HEAD
 //   private $smsSender;

 /*   public function __construct(QuizRepository $quizRepository, NotificationServer $notificationServer, TwilioSmsSender $smsSender)
=======
    private $smsSender;

    public function __construct(QuizRepository $quizRepository, NotificationServer $notificationServer, TwilioSmsSender $smsSender)
>>>>>>> 9245021fbb87523cb7633316c1f0514e2a867ea5
    {
        $this->quizRepository = $quizRepository;
        $this->notificationServer = $notificationServer;
        $this->smsSender = $smsSender;
    }
<<<<<<< HEAD
 */ 
public function __construct(QuizRepository $quizRepository, NotificationServer $notificationServer)
{
    $this->quizRepository = $quizRepository;
    $this->notificationServer = $notificationServer;
  //  $this->smsSender = $smsSender;
}

=======
>>>>>>> 9245021fbb87523cb7633316c1f0514e2a867ea5

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
        $this->addFlash('Bingo', 'Quiz approuvé ');

        // Send a notification to all connected clients
        $message = "Your quiz has been approved!";
        $payload = [
            'type' => 'notification',
            'message' => $message,
        ];
        $this->notificationServer->sendNotification($payload);

        // Send SMS notification (commented)
<<<<<<< HEAD
       // $toPhoneNumber = '+21652662266'; // Replace this with the recipient's phone number
       // $smsMessage = 'Votre quiz a été approuvé !';
     //   $this->smsSender->sendSms($toPhoneNumber, $smsMessage);
=======
        // $toPhoneNumber = '+21652662266'; // Replace this with the recipient's phone number
        // $smsMessage = 'Votre quiz a été approuvé !';
        // $this->smsSender->sendSms($toPhoneNumber, $smsMessage);
>>>>>>> 9245021fbb87523cb7633316c1f0514e2a867ea5
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
<<<<<<< HEAD
        $this->addFlash('Oups', 'Quiz disapprové.');
=======
        $this->addFlash('warning', 'Quiz disapproved successfully.');
>>>>>>> 9245021fbb87523cb7633316c1f0514e2a867ea5
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
  

    /**
     * @Route("/admin/ajax-search", name="quizzes_ajax_search")
     */
    public function ajaxSearch(Request $request, QuizRepository $quizRepository): JsonResponse
    {
        $query = $request->query->get('q', '');
        $quizzes = $quizRepository->searchAdmin($query);

        $html = $this->renderView('_quizzes_list.html.twig', [
            'quizzes' => $quizzes,
        ]);

        return new JsonResponse(['html' => $html]);
    }
    
}

    



/*    public function approveQuiz(Request $request, Quiz $quiz): Response
    {
        if ($this->isCsrfTokenValid('approve'.$quiz->getId(), $request->request->get('_token'))) {
            $quiz->setIsApproved(true);
            $this->quizRepository->save($quiz, true);
            $this->addFlash('success', 'Quiz approved successfully.');
        }

        return $this->redirectToRoute('admin_quiz_index');
    } */



 /*
    public function approveQuiz(Request $request, Quiz $quiz): Response
    {
        if ($this->isCsrfTokenValid('approve'.$quiz->getId(), $request->request->get('_token'))) {
            $quiz->setIsApproved(true);
            $this->quizRepository->save($quiz, true);
            $this->addFlash('success', 'Quiz approved successfully.');

            // Send SMS notification
            $toPhoneNumber = '+21652662266'; // Replace this with the recipient's phone number
            $smsMessage = 'Votre quiz a été approuvé !';
            $this->smsSender->sendSms($toPhoneNumber, $smsMessage);
        }

        return $this->redirectToRoute('admin_quiz_index');
    } 
    */