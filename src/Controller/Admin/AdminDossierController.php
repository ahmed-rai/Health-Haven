<?php

namespace App\Controller\Admin;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Dossier;
use App\Repository\DossierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Pusher\Pusher;

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

    //**
     // @Route("/dossiers", name="dossiers_index")
     // */ 
   /*  public function index(): Response
    {
        $dossiers = $this->dossierRepository->findAll();

        return $this->render('admin/dossiers.html.twig', [
            'dossiers' => $dossiers,
        ]);
    }
  */


#[Route('/dossier/popular-medications', name: 'app_dossier_popular_medications')]
public function popularMedications(DossierRepository $dossierRepository): Response
{
    $medications = $dossierRepository->findPopularMedications();

    return $this->render('dossier/popular_medications.html.twig', [
        'medications' => $medications,
    ]);
}


public function sendNotification()
{
    $options = [
        'cluster' => $_ENV['PUSHER_CLUSTER'],
        'useTLS' => true,
    ];

    $pusher = new Pusher(
        $_ENV['PUSHER_KEY'],
        $_ENV['PUSHER_SECRET'],
        $_ENV['PUSHER_APP_ID'],
        $options
    );

    $data['message'] = 'Hello, this is a notification';
    $pusher->trigger('notification-channel', 'new-notification', $data);
}

    /**
     * @Route("/dossiers", name="admin_dossier_index")
     */
    public function index(DossierRepository $dossierRepository): Response
    {
        $dossiers = $dossierRepository->findAll();
        $medications = $dossierRepository->findPopularMedications();

        return $this->render('admin/dossiers.html.twig', [
            'dossiers' => $dossiers,
            'medications' => $medications,
        ]);
    }

 /*
     @Route("/dossiers/search", name="dossiers_search")
     */
     /* public function search(Request $request): Response
    {
        $query = $request->query->get('q', '');
        $dossiers = $this->dossierRepository->searchAdmin($query);

        return $this->render('admin/dossiers.html.twig', [
            'dossiers' => $dossiers,
        ]);
    } */ 





    
  
     /*  @Route("/dossiers/search/json", name="dossiers_search_json") public function searchJson(Request $request): JsonResponse
    {
        $query = $request->query->get('q', '');
        $dossiers = $this->dossierRepository->searchAdmin($query);

        return $this->json($dossiers);
    } */


/**
 * @Route("/dossiers/ajax-search", name="dossiers_ajax_search")
 */
public function ajaxSearch(Request $request): JsonResponse
{
    $query = $request->query->get('q', ''); // Provide a default value (empty string) if 'q' is not set

    $dossiers = $this->dossierRepository->searchAdmin($query);

    return $this->json([
        'html' => $this->renderView('admin/_dossiers_list.html.twig', [
            'dossiers' => $dossiers,
        ]),
    ]);
}


     /* 
 * @Route("/dossiers/admin-search", name="admin_dossiers_search")
 
public function adminSearch(Request $request): Response
{
    $query = $request->query->get('q', '');

    $dossiers = $this->dossierRepository->searchAdmin($query);

    return $this->render('admin/dossiers.html.twig', [
        'dossiers' => $dossiers,
    ]);
}
*/ 

    /**
 * @Route("/dossiers/search", name="dossiers_search")
 */
// public function search(Request $request): Response

/* {
    $query = $request->query->get('q', '');

    $dossiers = $this->dossierRepository->search($query);

    return $this->render('admin/dossiers.html.twig', [
        'dossiers' => $dossiers,
    ]);
} */

}
