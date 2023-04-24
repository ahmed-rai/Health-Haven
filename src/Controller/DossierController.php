<?php

namespace App\Controller;

use App\Entity\Dossier;
use App\Form\Dossier1Type;
use App\Repository\DossierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;


#[Route('/dossier')]
class DossierController extends AbstractController
{
    #[Route('/', name: 'app_dossier_index', methods: ['GET'])]
    public function index(DossierRepository $dossierRepository): Response
    {
        return $this->render('dossier/index.html.twig', [
            'dossiers' => $dossierRepository->findAll(),
        ]);
    }
    #[Route('/new', name: 'app_dossier_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $dossier = new Dossier();
        $form = $this->createForm(Dossier1Type::class, $dossier);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($dossier);
            $entityManager->flush();
    
            return $this->redirectToRoute('app_dossier_index', [], Response::HTTP_SEE_OTHER);
        }
    
        return $this->render('dossier/new.html.twig', [
            'dossier' => $dossier,
            'form' => $form->createView(),
        ]);
    } /* 
    #[Route('/search/{query}', name: 'app_dossier_search', methods: ['GET'])]
public function search(DossierRepository $dossierRepository, string $query): Response
{
    $dossiers = $dossierRepository->findAllBySearchQuery($query);

    return $this->render('dossier/index.html.twig', [
        'dossiers' => $dossiers,
    ]);
}

*/

/**
 * @Route("/dossier/search", name="app_dossier_search")
 */
public function search(Request $request): Response
{
    $query = $request->query->get('q', '');

    $dossiers = $this->getDoctrine()
        ->getRepository(Dossier::class)
        ->search($query);

    return $this->render('dossier/index.html.twig', [
        'dossiers' => $dossiers,
    ]);
}


    #[Route('/{id}', name: 'app_dossier_show', methods: ['GET'])]
    public function show(Dossier $dossier): Response
    {
        return $this->render('dossier/show.html.twig', [
            'dossier' => $dossier,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_dossier_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Dossier $dossier, DossierRepository $dossierRepository): Response
    {
        $form = $this->createForm(Dossier1Type::class, $dossier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $dossierRepository->save($dossier, true);

            return $this->redirectToRoute('app_dossier_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('dossier/edit.html.twig', [
            'dossier' => $dossier,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_dossier_delete', methods: ['POST'])]
    public function delete(Request $request, Dossier $dossier, DossierRepository $dossierRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$dossier->getId(), $request->request->get('_token'))) {
            $dossierRepository->remove($dossier, true);
        }

        return $this->redirectToRoute('app_dossier_index', [], Response::HTTP_SEE_OTHER);
    }

  /**
 * @Route("dossier/export", name="dossier_export", methods={"GET"})
 */
public function export(): Response
{
    $dossiers = $this->getDoctrine()->getRepository(Dossier::class)->findAll();
    
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    
    // Set the headers for the Excel file
    $sheet->setCellValue('A1', 'Nom');
    $sheet->setCellValue('B1', 'Médicaments');
    $sheet->setCellValue('C1', 'Date de création');
    $sheet->setCellValue('D1', 'Phobies');
    $sheet->setCellValue('E1', 'Résultats');
    
    // Fill in the data for each dossier
    $row = 2;
    foreach ($dossiers as $dossier) {
        $sheet->setCellValue('A' . $row, $dossier->getNom());
        $sheet->setCellValue('B' . $row, $dossier->getMedicaments());
        $sheet->setCellValue('C' . $row, $dossier->getDateCreation());
        $sheet->setCellValue('D' . $row, $dossier->getPhobies());
        $sheet->setCellValue('E' . $row, $dossier->getResultats());
        
        $row++;
    }
    
    // Create the Excel writer and write the spreadsheet to a file
    $writer = new Xlsx($spreadsheet);
    $fileName = 'dossiers.xlsx';
    $tempFile = tmpfile();
    $filePath = stream_get_meta_data($tempFile)['uri'];
    $writer->save($filePath);
    
    // Create the response object and set the headers
 
    $response = new Response(file_get_contents($filePath));
    $response->headers->set('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    $response->headers->set('Content-Disposition', $response->headers->makeDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT, $fileName));
    
    // Clean up the temporary file
    fclose($tempFile);
    
    return $response;
}

}
