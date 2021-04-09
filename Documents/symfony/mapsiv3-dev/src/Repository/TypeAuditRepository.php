<?php

namespace App\Repository;

use App\Entity\TypeAudit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TypeAudit|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeAudit|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeAudit[]    findAll()
 * @method TypeAudit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeAuditRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeAudit::class);
    }

    // /**
    //  * @return TypeAudit[] Returns an array of TypeAudit objects
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
    public function findOneBySomeField($value): ?TypeAudit
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
