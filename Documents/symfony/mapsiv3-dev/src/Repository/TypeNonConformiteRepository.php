<?php

namespace App\Repository;

use App\Entity\TypeNonConformite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TypeNonConformite|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeNonConformite|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeNonConformite[]    findAll()
 * @method TypeNonConformite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeNonConformiteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeNonConformite::class);
    }

    // /**
    //  * @return TypeNonConformite[] Returns an array of TypeNonConformite objects
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
    public function findOneBySomeField($value): ?TypeNonConformite
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
