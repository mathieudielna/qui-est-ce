<?php

namespace App\Repository;

use App\Entity\TypeSupport;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TypeSupport|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeSupport|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeSupport[]    findAll()
 * @method TypeSupport[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeSupportRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TypeSupport::class);
    }

    // /**
    //  * @return TypeSupport[] Returns an array of TypeSupport objects
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
    public function findOneBySomeField($value): ?TypeSupport
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
