<?php

namespace App\Repository;

use App\Entity\TypePriorite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TypePriorite|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypePriorite|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypePriorite[]    findAll()
 * @method TypePriorite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypePrioriteRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TypePriorite::class);
    }

    // /**
    //  * @return TypePriorite[] Returns an array of TypePriorite objects
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
    public function findOneBySomeField($value): ?TypePriorite
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
