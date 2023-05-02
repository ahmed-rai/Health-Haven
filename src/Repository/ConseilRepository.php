<?php

namespace App\Repository;


use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Conseil>
 *
 * @method Conseil|null find($id, $lockMode = null, $lockVersion = null)
 * @method Conseil|null findOneBy(array $criteria, array $orderBy = null)
 * @method Conseil[]    findAll()
 * @method Conseil[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConseilRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Conseil::class);
    }

    public function changeDislikeToLike(Conseil $conseil, LikeRepository $likeRepository)
    {
        $user = $likeRepository->findOneBy(['conseil' => $conseil, 'iduser' => $user->getId()]);
        $user->setNom('Likee');
        $em = $this->getEntityManager();
        $em->persist($user);
        $em->flush();
    }

    public function updateRating(Conseil $conseil)
    {
        $likes = count($conseil->getLikes());
        $dislikes = count($conseil->getDislikes());
        $rating = ($likes - $dislikes) / max(1, ($likes + $dislikes));
        $conseil->setRating($rating);
        $em = $this->getEntityManager();
        $em->persist($conseil);
        $em->flush();
    }
}
