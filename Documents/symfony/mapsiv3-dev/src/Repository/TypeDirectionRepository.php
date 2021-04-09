<?php

namespace App\Repository;

use App\Entity\TypeDirection;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TypeDirection|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeDirection|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeDirection[]    findAll()
 * @method TypeDirection[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeDirectionRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TypeDirection::class);
    }

    // /**
    //  * @return TypeDirection[] Returns an array of TypeDirection objects
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
    public function findOneBySomeField($value): ?TypeDirection
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
