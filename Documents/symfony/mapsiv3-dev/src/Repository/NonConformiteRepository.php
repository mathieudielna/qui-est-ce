<?php

namespace App\Repository;

use App\Entity\NonConformite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method NonConformite|null find($id, $lockMode = null, $lockVersion = null)
 * @method NonConformite|null findOneBy(array $criteria, array $orderBy = null)
 * @method NonConformite[]    findAll()
 * @method NonConformite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NonConformiteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NonConformite::class);
    }

    // /**
    //  * @return NonConformite[] Returns an array of NonConformite objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?NonConformite
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
