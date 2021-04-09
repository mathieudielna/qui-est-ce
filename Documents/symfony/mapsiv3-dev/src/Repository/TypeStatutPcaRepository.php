<?php

namespace App\Repository;

use App\Entity\TypeStatutPca;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TypeStatutPca|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeStatutPca|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeStatutPca[]    findAll()
 * @method TypeStatutPca[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeStatutPcaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeStatutPca::class);
    }

    // /**
    //  * @return TypeStatutPca[] Returns an array of TypeStatutPca objects
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
    public function findOneBySomeField($value): ?TypeStatutPca
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
