<?php

namespace App\Repository;

use App\Entity\PcaEvenementChronoPrepa;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PcaEvenementChronoPrepa|null find($id, $lockMode = null, $lockVersion = null)
 * @method PcaEvenementChronoPrepa|null findOneBy(array $criteria, array $orderBy = null)
 * @method PcaEvenementChronoPrepa[]    findAll()
 * @method PcaEvenementChronoPrepa[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PcaEvenementChronoPrepaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PcaEvenementChronoPrepa::class);
    }

    // /**
    //  * @return PcaEvenementChronoPrepa[] Returns an array of PcaEvenementChronoPrepa objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PcaEvenementChronoPrepa
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
