<?php

namespace App\Controller;

use App\Entity\Conseil;
use App\Entity\Results;
use App\Form\ResultsType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use PHPMailer\PHPMailer\PHPMailer;
use Symfony\Component\Mailer\MailerInterface;


#[Route('/results')]
class ResultsController extends AbstractController
{
    #[Route('/', name: 'app_results_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $results = $entityManager
            ->getRepository(Results::class)
            ->findAll();

        return $this->render('results/index.html.twig', [
            'results' => $results,
        ]);
    }
    #[Route('/Back', name: 'app_results_indexBack', methods: ['GET'])]
    public function indexBack(EntityManagerInterface $entityManager): Response
    {
        $results= $entityManager
            ->getRepository(Results::class)
            ->findAll();

        return $this->render('results/indexBack.html.twig', [
            'results' => $results,
        ]);
    }
    #[Route('Back/{idRslt}', name: 'app_results_showBack', methods: ['GET'])]
    public function showBack(Results $result): Response
    {
        return $this->render('results/showBack.html.twig', [
            'result' => $result,
        ]);
    }

    #[Route('/new', name: 'app_results_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, MailerInterface $mailer): Response
    {
        $result = new Results();
        $form = $this->createForm(ResultsType::class, $result);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($result);
            $entityManager->flush();

       
        
        $mail = new PHPMailer(true);

        $mail->isSMTP();// Set mailer to use SMTP
        $mail->CharSet = "utf-8";// set charset to utf8
        $mail->SMTPAuth = true;// Enable SMTP authentication
        $mail->SMTPSecure = 'tls';// Enable TLS encryption, ssl also accepted

        $mail->Host = 'smtp.gmail.com';// Specify main and backup SMTP servers
        $mail->Port = 587;// TCP port to connect to
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        $mail->isHTML(true);// Set email format to HTML

        $mail->Username = 'ghaith.ameur@esprit.tn';// SMTP username
        $mail->Password ='223AMT0882';
        $mail->setFrom('ghaith.ameur@esprit.tn', 'Admin');//Your application NAME and EMAIL
        $mail->Subject = 'Nouveau Résultat';//Message subject
        $mail->Body = '<h1>Vous Avez Un Nouveau Resultat </h1>';// Message body
        $mail->addAddress('ghaith.ameur@esprit.tn', 'User Name');// Target email


        $mail->send();
        return $this->redirectToRoute('app_results_indexBack', [], Response::HTTP_SEE_OTHER);
    }

        return $this->renderForm('results/new.html.twig', [
            'result' => $result,
            'form' => $form,
        ]);
    }

    #[Route('/{idRslt}', name: 'app_results_show', methods: ['GET'])]
    public function show(Results $result): Response
    {
        return $this->render('results/show.html.twig', [
            'result' => $result,
        ]);
    }

    #[Route('/{idRslt}/edit', name: 'app_results_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Results $result, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ResultsType::class, $result);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_results_indexBack', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('results/edit.html.twig', [
            'result' => $result,
            'form' => $form,
        ]);
    }

    #[Route('/{idRslt}', name: 'app_results_delete', methods: ['POST'])]
    public function delete(Request $request, Results $result, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$result->getIdRslt(), $request->request->get('_token'))) {
            $entityManager->remove($result);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_results_indexBack', [], Response::HTTP_SEE_OTHER);
    }
}
