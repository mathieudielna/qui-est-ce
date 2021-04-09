<?php

namespace App\Repository;

use App\Entity\TypeDcpsecu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TypeDcpsecu|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeDcpsecu|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeDcpsecu[]    findAll()
 * @method TypeDcpsecu[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeDcpsecuRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeDcpsecu::class);
    }

    // /**
    //  * @return TypeDcpsecu[] Returns an array of TypeDcpsecu objects
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
    public function findOneBySomeField($value): ?TypeDcpsecu
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
