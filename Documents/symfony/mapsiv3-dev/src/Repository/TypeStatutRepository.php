<?php

namespace App\Repository;

use App\Entity\TypeStatut;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TypeStatut|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeStatut|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeStatut[]    findAll()
 * @method TypeStatut[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeStatutRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TypeStatut::class);
    }

    // /**
    //  * @return TypeStatut[] Returns an array of TypeStatut objects
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
    public function findOneBySomeField($value): ?TypeStatut
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
