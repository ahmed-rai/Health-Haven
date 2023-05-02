<?php

namespace App\Controller;

use App\Entity\Pharmacie;
use App\Entity\Produitspara;
use App\Form\ProduitsparaType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/produitspara')]
class ProduitsparaController extends AbstractController
{
    #[Route('/', name: 'app_produitspara_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $produitsparas = $entityManager
            ->getRepository(Produitspara::class)
            ->findAll();

        return $this->render('produitspara/index.html.twig', [
            'produitsparas' => $produitsparas,
        ]);
    }
    #[Route('/Back', name: 'app_produitspara_indexBack', methods: ['GET'])]
    public function indexBack(EntityManagerInterface $entityManager): Response
    {
        $produitsparas = $entityManager
            ->getRepository(Produitspara::class)
            ->findAll();

        return $this->render('produitspara/indexBack.html.twig', [
            'produitsparas' => $produitsparas,
        ]);
    }

    #[Route('/new', name: 'app_produitspara_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $produitspara = new Produitspara();
        $form = $this->createForm(ProduitsparaType::class, $produitspara);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($produitspara);
            $entityManager->flush();

            return $this->redirectToRoute('app_produitspara_indexBack', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('produitspara/new.html.twig', [
            'produitspara' => $produitspara,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_produitspara_show', methods: ['GET'])]
    public function show(Produitspara $produitspara): Response
    {
        return $this->render('produitspara/show.html.twig', [
            'produitspara' => $produitspara,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_produitspara_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Produitspara $produitspara, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ProduitsparaType::class, $produitspara);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_produitspara_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('produitspara/edit.html.twig', [
            'produitspara' => $produitspara,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_produitspara_delete', methods: ['POST'])]
    public function delete(Request $request, Produitspara $produitspara, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$produitspara->getId(), $request->request->get('_token'))) {
            $entityManager->remove($produitspara);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_produitspara_index', [], Response::HTTP_SEE_OTHER);
    }
}
