<?php

namespace App\Repository;

use App\Entity\Test;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Test|null find($id, $lockMode = null, $lockVersion = null)
 * @method Test|null findOneBy(array $criteria, array $orderBy = null)
 * @method Test[]    findAll()
 * @method Test[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TestRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Test::class);
    }

    public function findAllWithQuiz()
    {
        return $this->createQueryBuilder('t')
            ->addSelect('q')
            ->leftJoin('t.quiz', 'q')
            ->getQuery()
            ->getResult();
    }

    public function save(Test $test, bool $flush = true)
    {
        $entityManager = $this->getEntityManager();
        $entityManager->persist($test);
        if ($flush) {
            $entityManager->flush();
        }
    }
    public function search(string $query): array
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.question LIKE :query OR t.answer1 LIKE :query OR t.answer2 LIKE :query OR t.answer3 LIKE :query OR t.answer4 LIKE :query')
            ->setParameter('query', '%' . $query . '%')
            ->getQuery()
            ->getResult();
    }
    


    public function remove(Test $test, bool $flush = true)
    {
        $entityManager = $this->getEntityManager();
        $entityManager->remove($test);
        if ($flush) {
            $entityManager->flush();
        }
    }
}
