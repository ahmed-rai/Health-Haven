<?php

namespace App\Controller;

use App\Entity\Conseil;
use App\Entity\Prescription;
use App\Form\PrescriptionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\PDFService;


#[Route('/prescription')]
class PrescriptionController extends AbstractController
{
    #[Route('/', name: 'app_prescription_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $prescriptions = $entityManager
            ->getRepository(Prescription::class)
            ->findAll();

        return $this->render('prescription/index.html.twig', [
            'prescriptions' => $prescriptions,
        ]);
    }
    #[Route('/Back', name: 'app_prescription_indexBack', methods: ['GET'])]
    public function indexBack(EntityManagerInterface $entityManager): Response
    {
        $prescriptions= $entityManager
            ->getRepository(Prescription::class)
            ->findAll();

        return $this->render('prescription/indexBack.html.twig', [
            'prescriptions' => $prescriptions,
        ]);}
        #[Route('/pdf/{id}', name: 'display_prescription_list')]
        public function listpdf(Prescription $prescriptions=null, PDFService $pdf ):Response
        {
          $html =$this->render('prescription/indexBack.html.twig', [
            'prescriptions' => $prescriptions,
          ]);
          $pdf->showPdf($html);
    }
    #[Route('/new', name: 'app_prescription_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $prescription = new Prescription();
        $form = $this->createForm(PrescriptionType::class, $prescription);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($prescription);
            $entityManager->flush();

            return $this->redirectToRoute('app_prescription_indexBack', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('prescription/new.html.twig', [
            'prescription' => $prescription,
            'form' => $form,
        ]);
    }

    #[Route('/{dosage}', name: 'app_prescription_show', methods: ['GET'])]
    public function show(Prescription $prescription): Response
    {
        return $this->render('prescription/show.html.twig', [
            'prescription' => $prescription,
        ]);
    }

    #[Route('/{dosage}/edit', name: 'app_prescription_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Prescription $prescription, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PrescriptionType::class, $prescription);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_prescription_indexBack', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('prescription/edit.html.twig', [
            'prescription' => $prescription,
            'form' => $form,
        ]);
    }

    #[Route('/{dosage}', name: 'app_prescription_delete', methods: ['POST'])]
    public function delete(Request $request, Prescription $prescription, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$prescription->getDosage(), $request->request->get('_token'))) {
            $entityManager->remove($prescription);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_prescription_indexBack', [], Response::HTTP_SEE_OTHER);
    }
}
