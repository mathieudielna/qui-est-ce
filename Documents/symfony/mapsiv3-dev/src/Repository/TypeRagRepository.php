<?php

namespace App\Repository;

use App\Entity\TypeRag;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TypeRag|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeRag|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeRag[]    findAll()
 * @method TypeRag[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeRagRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeRag::class);
    }

    // /**
    //  * @return TypeRag[] Returns an array of TypeRag objects
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
    public function findOneBySomeField($value): ?TypeRag
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
