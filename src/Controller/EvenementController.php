<?php

namespace App\Controller;

use App\Entity\Conseil;
use App\Entity\Evenement;
use App\Form\EvenementType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use PHPMailer\PHPMailer\PHPMailer;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\String\Slugger\SluggerInterface;


#[Route('/evenement')]
class EvenementController extends AbstractController
{
    #[Route('/', name: 'app_evenement_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $evenements = $entityManager
            ->getRepository(Evenement::class)
            ->findAll();

        return $this->render('evenement/index.html.twig', [
            'evenements' => $evenements,
        ]);
    }
    #[Route('/Back', name: 'app_evenement_indexBack', methods: ['GET'])]
    public function indexBack(EntityManagerInterface $entityManager): Response
    {
        $evenements= $entityManager
            ->getRepository(Evenement::class)
            ->findAll();

        return $this->render('evenement/indexBack.html.twig', [
            'evenements' => $evenements,
        ]);
    }
     /**
     * @Route("/recherche", name="recherche3", methods={"GET","POST"})
     */
    public function recherche(Request $req, EntityManagerInterface $entityManager)
    {
        $data = $req->get('searche3');
        $repository = $entityManager->getRepository(Evenement::class);
        $evenements = $repository->findBy(['nom' => $data]);
        return $this->render('evenement/index.html.twig', [
            'evenements' => $evenements
        ]);
    }
   
/**
 * @Route("/event/tri-date", name="evenements_tri_date")
 */
public function trierParDate(EntityManagerInterface $entityManager)
{
    $repository = $entityManager->getRepository(Evenement::class);
    $evenements = $repository->findBy([], ['dteeve' => 'ASC']);

    return $this->render('evenement/indexBack.html.twig', [
        'evenements' => $evenements
    ]);
}
    #[Route('/new', name: 'app_evenement_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager,MailerInterface $mailer, SluggerInterface $slugger): Response
    {
        $evenement = new Evenement();
        $form = $this->createForm(EvenementType::class, $evenement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($evenement);
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

            $mail->Username = 'mohamediheb.taboubi@esprit.tn';// SMTP username
            $mail->Password ='223AMT2586';
            $mail->setFrom('mohamediheb.taboubi@esprit.tn', 'Admin Evènements');//Your application NAME and EMAIL
            $mail->Subject = 'Nouveau Event';//Message subject
            $mail->Body = '<h1>Vous Avez Un Nouveau Event  ajouté </h1>';// Message body
            $mail->addAddress('mohamediheb.taboubi@esprit.tn', 'User Name');// Target email


            $mail->send();

            return $this->redirectToRoute('app_evenement_indexBack', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('evenement/new.html.twig', [
            'evenement' => $evenement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_evenement_show', methods: ['GET'])]
    public function show(Evenement $evenement): Response
    {
        return $this->render('evenement/show.html.twig', [
            'evenement' => $evenement,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_evenement_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Evenement $evenement, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EvenementType::class, $evenement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_evenement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('evenement/edit.html.twig', [
            'evenement' => $evenement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_evenement_delete', methods: ['POST'])]
    public function delete(Request $request, Evenement $evenement, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$evenement->getId(), $request->request->get('_token'))) {
            $entityManager->remove($evenement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_evenement_indexBack', [], Response::HTTP_SEE_OTHER);
    }
}
