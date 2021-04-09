<?php

namespace App\Repository;

use App\Entity\Dcpsensible;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Dcpsensible|null find($id, $lockMode = null, $lockVersion = null)
 * @method Dcpsensible|null findOneBy(array $criteria, array $orderBy = null)
 * @method Dcpsensible[]    findAll()
 * @method Dcpsensible[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DcpsensibleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Dcpsensible::class);
    }

    // /**
    //  * @return Dcpsensible[] Returns an array of Dcpsensible objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Dcpsensible
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
