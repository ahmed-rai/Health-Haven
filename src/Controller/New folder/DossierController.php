<?php
namespace App\Controller;

use App\Entity\Dossier;
use App\Form\DossierType;
use App\Repository\DossierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

/**
 * @Route("/dossier")
 */
class DossierController extends AbstractController
{
    /**
     * @Route("/", name="dossier_index", methods={"GET"})
     */
    public function index(DossierRepository $dossierRepository): Response
    {
        return $this->render('dossier/index.html.twig', [
            'dossiers' => $dossierRepository->findAll(),
        ]);
    }
    
private function createDeleteForm(Dossier $dossier)
{
    return $this->createFormBuilder()
        ->setAction($this->generateUrl('dossier_delete', ['id' => $dossier->getId()]))
        ->setMethod('DELETE')
        ->add('id', HiddenType::class)
        ->add('submit', SubmitType::class, [
            'label' => 'Suppr.',
            'attr' => ['class' => 'btn btn-danger'],
        ])
        ->getForm();
}

    /**
     * @Route("/new", name="dossier_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $dossier = new Dossier();
        $form = $this->createForm(DossierType::class, $dossier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($dossier);
            $entityManager->flush();

            return $this->redirectToRoute('dossier_index');
        }

        return $this->render('dossier/new.html.twig', [
            'dossier' => $dossier,
            'form' => $form->createView(),
        ]);
    }
// src/Controller/DossierController.php

/**
 * @Route("/{id}", name="dossier_show", methods={"GET"})
 */
public function show(Dossier $dossier): Response
{
    $deleteForm = $this->createDeleteForm($dossier);

    return $this->render('dossier/show.html.twig', [
        'dossier' => $dossier,
        'delete_form' => $deleteForm->createView(),
    ]);
}


    /**
     * @Route("/{id}/edit", name="dossier_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Dossier $dossier): Response
    {
        $form = $this->createForm(DossierType::class, $dossier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('dossier_index', [
                'id' => $dossier->getId(),
            ]);
        }

        return $this->render('dossier/edit.html.twig', [
            'dossier' => $dossier,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="dossier_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Dossier $dossier): Response
    {
        if ($this->isCsrfTokenValid('delete'.$dossier->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($dossier);
            $entityManager->flush();
        }

        return $this->redirectToRoute('dossier_index');
    }
}
