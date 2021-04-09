<?php

namespace App\Repository;

use App\Entity\TypeDcpsensible;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TypeDcpsensible|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeDcpsensible|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeDcpsensible[]    findAll()
 * @method TypeDcpsensible[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeDcpsensibleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeDcpsensible::class);
    }

    // /**
    //  * @return TypeDcpsensible[] Returns an array of TypeDcpsensible objects
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
    public function findOneBySomeField($value): ?TypeDcpsensible
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
