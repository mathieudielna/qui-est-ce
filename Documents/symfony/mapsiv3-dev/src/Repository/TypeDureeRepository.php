<?php

namespace App\Repository;

use App\Entity\TypeDuree;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TypeDuree|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeDuree|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeDuree[]    findAll()
 * @method TypeDuree[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeDureeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TypeDuree::class);
    }

    // /**
    //  * @return TypeDuree[] Returns an array of TypeDuree objects
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
    public function findOneBySomeField($value): ?TypeDuree
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
