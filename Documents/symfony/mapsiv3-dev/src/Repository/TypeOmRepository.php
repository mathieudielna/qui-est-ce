<?php

namespace App\Repository;

use App\Entity\TypeOm;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TypeOm|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeOm|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeOm[]    findAll()
 * @method TypeOm[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeOmRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TypeOm::class);
    }

    // /**
    //  * @return TypeOm[] Returns an array of TypeOm objects
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
    public function findOneBySomeField($value): ?TypeOm
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
