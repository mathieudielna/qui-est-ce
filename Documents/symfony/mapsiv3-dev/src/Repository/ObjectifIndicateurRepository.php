<?php

namespace App\Repository;

use App\Entity\ObjectifIndicateur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ObjectifIndicateur|null find($id, $lockMode = null, $lockVersion = null)
 * @method ObjectifIndicateur|null findOneBy(array $criteria, array $orderBy = null)
 * @method ObjectifIndicateur[]    findAll()
 * @method ObjectifIndicateur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ObjectifIndicateurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ObjectifIndicateur::class);
    }

    // /**
    //  * @return ObjectifIndicateur[] Returns an array of ObjectifIndicateur objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ObjectifIndicateur
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
