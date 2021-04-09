<?php

namespace App\Repository;

use App\Entity\FluxConnectActivite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method FluxConnectActivite|null find($id, $lockMode = null, $lockVersion = null)
 * @method FluxConnectActivite|null findOneBy(array $criteria, array $orderBy = null)
 * @method FluxConnectActivite[]    findAll()
 * @method FluxConnectActivite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FluxConnectActiviteRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, FluxConnectActivite::class);
    }

    // /**
    //  * @return FluxConnectActivite[] Returns an array of FluxConnectActivite objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FluxConnectActivite
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
