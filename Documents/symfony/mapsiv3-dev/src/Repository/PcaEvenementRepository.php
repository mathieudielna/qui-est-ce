<?php

namespace App\Repository;

use App\Entity\PcaEvenement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method PcaEvenement|null find($id, $lockMode = null, $lockVersion = null)
 * @method PcaEvenement|null findOneBy(array $criteria, array $orderBy = null)
 * @method PcaEvenement[]    findAll()
 * @method PcaEvenement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PcaEvenementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PcaEvenement::class);
    }

    // /**
    //  * @return PcaEvenement[] Returns an array of PcaEvenement objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PcaEvenement
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
