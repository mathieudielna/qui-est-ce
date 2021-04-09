<?php

namespace App\Repository;

use App\Entity\OuiNon;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method OuiNon|null find($id, $lockMode = null, $lockVersion = null)
 * @method OuiNon|null findOneBy(array $criteria, array $orderBy = null)
 * @method OuiNon[]    findAll()
 * @method OuiNon[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OuiNonRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, OuiNon::class);
    }

    // /**
    //  * @return OuiNon[] Returns an array of OuiNon objects
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
    public function findOneBySomeField($value): ?OuiNon
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
