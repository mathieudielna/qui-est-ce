<?php

namespace App\Repository;

use App\Entity\TypeAxevolet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TypeAxevolet|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeAxevolet|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeAxevolet[]    findAll()
 * @method TypeAxevolet[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeAxevoletRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TypeAxevolet::class);
    }

    // /**
    //  * @return TypeAxevolet[] Returns an array of TypeAxevolet objects
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
    public function findOneBySomeField($value): ?TypeAxevolet
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
