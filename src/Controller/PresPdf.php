<?php
 
namespace App\Controller;
 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Dompdf\Dompdf;
use Doctrine\ORM\EntityManagerInterface;
use Dompdf\Options;

use App\Entity\Prescription;
use App\Repository\DonRepository;
        
class PresPdf extends AbstractController
{
  
    /**
     * @Route("/pdf", name="pdf")
     */
    public function pdf(EntityManagerInterface $em)
    {
        {
            $don=$em->getRepository(Prescription::class)->findAll();
            
    
            // On définit les options du PDF
            $pdfOptions = new Options();
            // Police par défaut
            $pdfOptions->set('defaultFont', 'Arial');
            $pdfOptions->setIsRemoteEnabled(true);
    
            // On instancie Dompdf
            $dompdf = new Dompdf($pdfOptions);
            
    
            // On génère le html
            $html = $this->renderView('preP/pindex.html.twig',
                ['b'=>$don ]);
           
    //
    
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();
    
            // On génère un nom de fichier
            $fichier = 'Tableau des Prescriptions.pdf';
    
            // On envoie le PDF au navigateur
            $dompdf->stream($fichier, [
                'Attachment' => true
            ]);
    
            return new Response();
        }
    }
 
   
   
}