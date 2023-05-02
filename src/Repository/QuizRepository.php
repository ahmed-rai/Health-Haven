<?php

namespace App\Repository;

use App\Entity\Quiz;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Quiz>
 *
 * @method Quiz|null find($id, $lockMode = null, $lockVersion = null)
 * @method Quiz|null findOneBy(array $criteria, array $orderBy = null)
 * @method Quiz[]    findAll()
 * @method Quiz[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuizRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Quiz::class);
    }

    public function save(Quiz $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Quiz $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
/*
    public function findApproved(): array
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.isApproved = true')
            ->getQuery()
            ->getResult();
    } */
/*
    public function findApproved()
{
    return $this->createQueryBuilder('q')
        ->andWhere('q.isApproved = :approved')
        ->setParameter('approved', true)
        ->getQuery()
        ->getResult();
}
 */

public function findApproved()
{
    return $this->createQueryBuilder('q')
        ->andWhere('q.isApproved = :approved')
        ->setParameter('approved', true)
        ->getQuery()
        ->getResult();
}


    public function findByPsy(User $psy)
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.psy = :psy')
            ->setParameter('psy', $psy)
            ->orderBy('q.id', 'ASC')
            ->getQuery()
            ->getResult();
    }
    public function search(string $query): array
{
    return $this->createQueryBuilder('q')
        ->andWhere('q.name LIKE :query OR q.description LIKE :query')
        ->setParameter('query', '%' . $query . '%')
        ->getQuery()
        ->getResult();
}

public function searchAdmin(string $query): array
{
    $qb = $this->createQueryBuilder('q')
        ->where('q.name LIKE :query')
        ->orWhere('q.description LIKE :query')
        ->setParameter('query', '%' . $query . '%')
        ->orderBy('q.id', 'ASC');

    return $qb->getQuery()->getResult();
}
    // Other methods such as findByExampleField, findOneBySomeField, etc. should be included here if needed
}
