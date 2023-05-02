<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UtilisateurController extends AbstractController
{
    #[Route('/Utilisateur', name: 'app_user')]
    public function index(): Response
    {
        return $this->render('Utilisateur/index.html.twig', [
            'controller_name' => 'UtilisateurController',
        ]);
    }
}
