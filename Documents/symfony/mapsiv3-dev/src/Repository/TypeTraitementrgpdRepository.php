<?php

namespace App\Repository;

use App\Entity\TypeTraitementrgpd;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TypeTraitementrgpd|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeTraitementrgpd|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeTraitementrgpd[]    findAll()
 * @method TypeTraitementrgpd[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeTraitementrgpdRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeTraitementrgpd::class);
    }

    // /**
    //  * @return TypeTraitementrgpd[] Returns an array of TypeTraitementrgpd objects
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
    public function findOneBySomeField($value): ?TypeTraitementrgpd
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
