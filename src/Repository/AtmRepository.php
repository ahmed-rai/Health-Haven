<?php
namespace App\Repository;

use Doctrine\ORM\QueryBuilder;
use App\Entity\Atm;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class AtmRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Atm::class);
    }

    public function searchByType(string $searchQuery)
    {
        return $this->createQueryBuilder('t')
            ->Where('t.type LIKE :query')
            ->setParameter('query', '%' . $searchQuery . '%')
            ->getQuery()
            ->getResult();
    }
}
