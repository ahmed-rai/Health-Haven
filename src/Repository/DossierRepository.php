<?php

namespace App\Repository;
use Doctrine\ORM\QueryBuilder;
use App\Entity\Dossier;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Dossier>
 *
 * @method Dossier|null find($id, $lockMode = null, $lockVersion = null)
 * @method Dossier|null findOneBy(array $criteria, array $orderBy = null)
 * @method Dossier[]    findAll()
 * @method Dossier[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DossierRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Dossier::class);
    }

    public function save(Dossier $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Dossier $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
/*
    public function findAllBySearchQuery(string $searchQuery): array
    {
        $queryBuilder = $this->createQueryBuilder('dossier');
    
        $queryBuilder->where('dossier.nom LIKE :searchQuery')
            ->orWhere('dossier.medicaments LIKE :searchQuery')
            ->orWhere('dossier.phobies LIKE :searchQuery')
            ->orWhere('dossier.resultats LIKE :searchQuery')
            ->setParameter('searchQuery', '%' . $searchQuery . '%');
    
        return $queryBuilder->getQuery()->getResult();
    }
    */
    public function search(string $query): array
{
    return $this->createQueryBuilder('d')
        ->andWhere('d.nom LIKE :query OR d.medicaments LIKE :query OR d.phobies LIKE :query OR d.resultats LIKE :query')
        ->setParameter('query', '%' . $query . '%')
        ->getQuery()
        ->getResult();
}


public function searchAdmin(string $query): array
{
    $qb = $this->createQueryBuilder('d');

    if (!empty($query)) {
        $qb->andWhere(
            $qb->expr()->orX(
                $qb->expr()->like('d.nom', ':query'),
                $qb->expr()->like('d.medicaments', ':query'),
                $qb->expr()->like('d.dateCreation', ':query'),
                $qb->expr()->like('d.phobies', ':query'),
                $qb->expr()->like('d.resultats', ':query')
            )
        )->setParameter('query', '%' . $query . '%');
    }

    return $qb->getQuery()->getResult();
}

public function findPopularMedications(int $limit = 10): array
{
    $qb = $this->createQueryBuilder('dossier');
    $qb->select('dossier.medicaments as medication, COUNT(dossier.id) as total')
        ->where($qb->expr()->isNotNull('dossier.medicaments'))
        ->groupBy('dossier.medicaments')
        ->orderBy('total', 'DESC')
        ->setMaxResults($limit);

    $query = $qb->getQuery();

    return $query->getResult();
}

}
//    /**
//     * @return Dossier[] Returns an array of Dossier objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('d.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Dossier
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

