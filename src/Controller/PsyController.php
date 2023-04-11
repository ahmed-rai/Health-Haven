<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PsyController extends AbstractController
{
    /**
     * @Route("/psy", name="psy")
     */
    public function index(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $psyUsers = $entityManager->getRepository(User::class)->findBy(['speciality' => 'Psy']);

        return $this->render('psy/list.html.twig', [
            'psyUsers' => $psyUsers,
        ]);
    }
    /**
     * @Route("/rendezvous/{id}", name="rendezvous")
     */
    public function rendezvousAction(int $id): Response
    {
        // Get the User entity for the given ID
        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository(User::class)->find($id);

        if (!$user) {
            throw $this->createNotFoundException('User not found for ID: ' . $id);
        }

        // Render the rendezvous taking page
        return $this->render('psy/rendezvous.html.twig', [
            'user' => $user,
        ]);
    }
}
