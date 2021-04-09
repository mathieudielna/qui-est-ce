<?php

namespace App\Repository;

use App\Entity\TypeStatutRisque;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TypeStatutRisque|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeStatutRisque|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeStatutRisque[]    findAll()
 * @method TypeStatutRisque[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeStatutRisqueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeStatutRisque::class);
    }

    // /**
    //  * @return TypeStatutRisque[] Returns an array of TypeStatutRisque objects
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
    public function findOneBySomeField($value): ?TypeStatutRisque
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
