<?php

namespace App\Controller;

use App\Entity\Conseil;
use App\Entity\Pharmacie;
use App\Form\ConseilType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\LikeRepository;
use App\Repository\ConseilRepository;
use Doctrine\Persistence\ManagerRegistry;


#[Route('/conseil')]
class ConseilController extends AbstractController
{
    #[Route('/', name: 'app_conseil_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $conseils = $entityManager
            ->getRepository(Conseil::class)
            ->findAll();

        return $this->render('conseil/index.html.twig', [
            'conseils' => $conseils,
        ]);
    }
    #[Route('/Back', name: 'app_conseil_indexBack', methods: ['GET'])]
    public function indexBack(EntityManagerInterface $entityManager): Response
    {
        $conseils= $entityManager
            ->getRepository(Conseil::class)
            ->findAll();

        return $this->render('conseil/indexBack.html.twig', [
            'conseils' => $conseils,
        ]);
    }
    #[Route('Back/{id}', name: 'app_conseil_showBack', methods: ['GET'])]
    public function showBack(Conseil $conseil): Response
    {
        return $this->render('conseil/showBack.html.twig', [
            'conseil' => $conseil,
        ]);
    }
    #[Route('/conseil/like/{id}', name: 'app_conseil_like', requirements: ['id' => '\d+'])]
public function like(Conseil $conseil, ConseilRepository $conseilRepository, Request $request, ManagerRegistry $doctrine, LikeRepository $likeRepository)
{
    $em = $doctrine->getManager();

    // Check if the user has already liked the conseil
    $like = $likeRepository->findLike($conseilRepository->find($conseil->getId()), $this->getUser());

    if (!$like) {
        // Add a new like
        $like = new Like();
        $like->setUser($this->getUser());
        $like->setConseil($conseil);
        $like->setIsLike(true);

        $em->persist($like);
        $em->flush();
    } elseif ($like->getIsLike() === false) {
        // Change dislike to like
        $like->setIsLike(true);

        $em->persist($like);
        $em->flush();
    }

    // Update the conseil rating
    $conseilRepository->updateRating($conseil);

    return $this->redirectToRoute('app_conseil_index');
}

#[Route('/conseil/dislike/{id}', name: 'app_conseil_dislike', requirements: ['id' => '\d+'])]
public function dislike(Conseil $conseil, ConseilRepository $conseilRepository, Request $request, ManagerRegistry $doctrine, LikeRepository $likeRepository)
{
    $em = $doctrine->getManager();

    // Check if the user has already disliked the conseil
    $like = $likeRepository->findLike($conseilRepository->find($conseil->getId()), $this->getUser());

    if (!$like) {
        // Add a new dislike
        $like = new Like();
        $like->setUser($this->getUser());
        $like->setConseil($conseil);
        $like->setIsLike(false);

        $em->persist($like);
        $em->flush();
    } elseif ($like->getIsLike() === true) {
        // Change like to dislike
        $like->setIsLike(false);

        $em->persist($like);
        $em->flush();
    }

    // Update the conseil rating
    $conseilRepository->updateRating($conseil);

    return $this->redirectToRoute('app_conseil_index');
}

      /**
     * @Route("/rechercheconseil", name="recherche1", methods={"GET","POST"})
     */
    public function recherche(Request $req, EntityManagerInterface $entityManager)
    {
        $data = $req->get('searche1');
        $repository = $entityManager->getRepository(Conseil::class);
        $conseils = $repository->findBy(['titre' => $data]);
        return $this->render('conseil/index.html.twig', [
            'conseils' => $conseils
        ]);
    }
    #[Route('/new', name: 'app_conseil_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $conseil = new Conseil();
        $form = $this->createForm(ConseilType::class, $conseil);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($conseil);
            $entityManager->flush();

            return $this->redirectToRoute('app_conseil_indexBack', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('conseil/new.html.twig', [
            'conseil' => $conseil,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_conseil_show', methods: ['GET'])]
    public function show(Conseil $conseil): Response
    {
        return $this->render('conseil/show.html.twig', [
            'conseil' => $conseil,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_conseil_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Conseil $conseil, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ConseilType::class, $conseil);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_conseil_indexBack', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('conseil/edit.html.twig', [
            'conseil' => $conseil,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_conseil_delete', methods: ['POST'])]
    public function delete(Request $request, Conseil $conseil, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$conseil->getId(), $request->request->get('_token'))) {
            $entityManager->remove($conseil);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_conseil_indexBack', [], Response::HTTP_SEE_OTHER);
    }
    public function hasLiked(Conseil $conseils,LikeRepository $likeRepository){

        $like = $likeRepository->findLike($conseils);

        if ($like == null){
            return false;
        }
        else{
            return true;
        }
    }

    public function hasDisliked(Conseil $conseils,LikeRepository $likeRepository){

     $dislike = $likeRepository->findDislike($conseils);

        if ($dislike == null){
            return false;
        }
        else{
            return true;
        }
    }
}
