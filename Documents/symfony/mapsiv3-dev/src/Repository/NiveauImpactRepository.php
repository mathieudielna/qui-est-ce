<?php

namespace App\Repository;

use App\Entity\NiveauImpact;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method NiveauImpact|null find($id, $lockMode = null, $lockVersion = null)
 * @method NiveauImpact|null findOneBy(array $criteria, array $orderBy = null)
 * @method NiveauImpact[]    findAll()
 * @method NiveauImpact[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NiveauImpactRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, NiveauImpact::class);
    }

    // /**
    //  * @return NiveauImpact[] Returns an array of NiveauImpact objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?NiveauImpact
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
