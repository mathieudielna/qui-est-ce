<?php

namespace App\Repository;

use App\Entity\PcaEvenementServTrack;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PcaEvenementServTrack|null find($id, $lockMode = null, $lockVersion = null)
 * @method PcaEvenementServTrack|null findOneBy(array $criteria, array $orderBy = null)
 * @method PcaEvenementServTrack[]    findAll()
 * @method PcaEvenementServTrack[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PcaEvenementServTrackRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PcaEvenementServTrack::class);
    }

    // /**
    //  * @return PcaEvenementServTrack[] Returns an array of PcaEvenementServTrack objects
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
    public function findOneBySomeField($value): ?PcaEvenementServTrack
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
