<?php

namespace App\Repository;

use App\Entity\TypeAspectEnv;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TypeAspectEnv|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeAspectEnv|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeAspectEnv[]    findAll()
 * @method TypeAspectEnv[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeAspectEnvRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeAspectEnv::class);
    }

    // /**
    //  * @return TypeAspectEnv[] Returns an array of TypeAspectEnv objects
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
    public function findOneBySomeField($value): ?TypeAspectEnv
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
