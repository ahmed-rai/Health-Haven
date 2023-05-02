<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(): Response
    {
        return $this->render('base.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }


    #[Route('/main/logout', name: 'app_mainlogout')]
    public function logout(): Response
    {
        return $this->render('acceuilwithoutlogin.html.twig', [

        ]);
    }

   
    #[Route('/homeadmin', name: 'app_mainhomeadmin')]
    public function indexback(EntityManagerInterface $entityManager): Response
    {$users = $entityManager
        ->getRepository(User::class)
        ->findAll();

        return $this->render('user/index.html.twig', [
            'users' => $users,
        ]);
    }
    #[Route('/registration', name: 'app_registration')]
    public function indexfront(): Response
    {
        return $this->render('front.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }
}
