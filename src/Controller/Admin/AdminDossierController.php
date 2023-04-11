<?php

namespace App\Controller\Admin;

use App\Entity\Dossier;
use App\Repository\DossierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin", name="admin_")
 */
class AdminDossierController extends AbstractController
{
    private $dossierRepository;

    public function __construct(DossierRepository $dossierRepository)
    {
        $this->dossierRepository = $dossierRepository;
    }

    /**
     * @Route("/dossiers", name="dossiers_index")
     */
    public function index(): Response
    {
        $dossiers = $this->dossierRepository->findAll();

        return $this->render('admin/dossiers.html.twig', [
            'dossiers' => $dossiers,
        ]);
    }
}
