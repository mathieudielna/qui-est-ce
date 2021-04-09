<?php

namespace App\Repository;

use App\Entity\TypePrevention;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TypePrevention|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypePrevention|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypePrevention[]    findAll()
 * @method TypePrevention[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypePreventionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypePrevention::class);
    }

    // /**
    //  * @return TypePrevention[] Returns an array of TypePrevention objects
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
    public function findOneBySomeField($value): ?TypePrevention
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
