<?php

namespace App\Controller\Admin;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Dossier;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Pusher\Pusher;


class AdminController extends AbstractController
{


    

#[Route('/listeUser', name: 'listeUser')]
public function listeUser(UserRepository $userRepository): Response
{
    
    return $this->render('user/index.html.twig', [
        'users' => $userRepository->findAll(),
    ]);

}





}
