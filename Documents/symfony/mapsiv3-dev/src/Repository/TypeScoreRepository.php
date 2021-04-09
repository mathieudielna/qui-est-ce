<?php

namespace App\Repository;

use App\Entity\TypeScore;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TypeScore|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeScore|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeScore[]    findAll()
 * @method TypeScore[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeScoreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeScore::class);
    }

    // /**
    //  * @return TypeScore[] Returns an array of TypeScore objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TypeScore
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
