<?php

namespace App\Repository;

use App\Entity\PsychologicalQuestion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PsychologicalQuestion>
 *
 * @method PsychologicalQuestion|null find($id, $lockMode = null, $lockVersion = null)
 * @method PsychologicalQuestion|null findOneBy(array $criteria, array $orderBy = null)
 * @method PsychologicalQuestion[]    findAll()
 * @method PsychologicalQuestion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PsychologicalQuestionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PsychologicalQuestion::class);
    }

    public function save(PsychologicalQuestion $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(PsychologicalQuestion $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return PsychologicalQuestion[] Returns an array of PsychologicalQuestion objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?PsychologicalQuestion
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
