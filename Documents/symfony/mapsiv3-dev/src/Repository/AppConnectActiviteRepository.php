<?php

namespace App\Repository;

use App\Entity\AppConnectActivite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method AppConnectActivite|null find($id, $lockMode = null, $lockVersion = null)
 * @method AppConnectActivite|null findOneBy(array $criteria, array $orderBy = null)
 * @method AppConnectActivite[]    findAll()
 * @method AppConnectActivite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AppConnectActiviteRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, AppConnectActivite::class);
    }

    // /**
    //  * @return AppConnectActivite[] Returns an array of AppConnectActivite objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AppConnectActivite
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
