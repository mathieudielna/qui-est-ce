<?php

namespace App\Repository;

use App\Entity\TypeTier;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TypeTier|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeTier|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeTier[]    findAll()
 * @method TypeTier[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeTierRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TypeTier::class);
    }

    // /**
    //  * @return TypeTier[] Returns an array of TypeTier objects
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
    public function findOneBySomeField($value): ?TypeTier
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
