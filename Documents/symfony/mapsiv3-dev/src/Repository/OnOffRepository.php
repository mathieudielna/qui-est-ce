<?php

namespace App\Repository;

use App\Entity\OnOff;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method OnOff|null find($id, $lockMode = null, $lockVersion = null)
 * @method OnOff|null findOneBy(array $criteria, array $orderBy = null)
 * @method OnOff[]    findAll()
 * @method OnOff[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OnOffRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, OnOff::class);
    }

    // /**
    //  * @return OnOff[] Returns an array of OnOff objects
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
    public function findOneBySomeField($value): ?OnOff
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
