<?php

namespace App\Controller;

use App\Entity\Atm;
use App\Form\AtmType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

use App\Repository\AtmRepository;

#[Route('/atm')]
class AtmController extends AbstractController
{
    #[Route('/', name: 'app_atm_index', methods: ['GET'])]
    public function index(Request $request, AtmRepository $atmRepository): Response
{
    $searchQuery = $request->query->get('q');

    if ($searchQuery) {
        $atm = $atmRepository->searchByType($searchQuery);
    } else {
        $atm = $atmRepository->findAll();
    }

    return $this->render('atm/index.html.twig', [
        'atm' => $atm,
        'searchQuery' => $searchQuery,
    ]);
}

    #[Route('/new', name: 'app_atm_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $atm = new Atm();
        $form = $this->createForm(AtmType::class, $atm);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($atm);
            $entityManager->flush();
    
            if ($request->isXmlHttpRequest()) {
                return $this->json([
                    'success' => true,
                    'atm' => [
                        'type' => $atm->getType(),
                        'dtetest' => $atm->getDtetest()->format('Y-m-d H:i:s')
                    ]
                ]);
            } else {
                return $this->redirectToRoute('app_atm_index', [], Response::HTTP_SEE_OTHER);
            }
        }
    
        return $this->renderForm('atm/new.html.twig', [
            'atm' => $atm,
            'form' => $form,
        ]);
    }
    

    #[Route('/{id}/show', name: 'app_atm_show', methods: ['GET'])]
    public function show(Atm $atm): Response
    {
        return $this->render('atm/show.html.twig', [
            'atm' => $atm,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_atm_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Atm $atm, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AtmType::class, $atm);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_atm_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('atm/edit.html.twig', [
            'atm' => $atm,
            'form' => $form,
        ]);
    }
    #[Route('/{id}', name: 'app_atm_delete', methods: ['POST'])]
    public function delete(Request $request, Atm $atm, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$atm->getId(), $request->request->get('_token'))) {
            $entityManager->remove($atm);
            $entityManager->flush();
        }
    
        return $this->redirectToRoute('app_atm_index', [], Response::HTTP_SEE_OTHER);
    }
    
    #[Route('/search', name: 'app_atm_search', methods: ['GET', 'POST'])]
    public function search(Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AtmSearchType::class);
    
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $criteria = $form->getData();
    
            // Query the database to retrieve the ATMs that match the search criteria
            $atms = $entityManager
                ->getRepository(Atm::class)
                ->findByCriteria($criteria);
    
            return $this->render('atm/index.html.twig', [
                'atm' => $atms,
            ]);
        }
    
        return $this->render('atm/search.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}

    

    
   

