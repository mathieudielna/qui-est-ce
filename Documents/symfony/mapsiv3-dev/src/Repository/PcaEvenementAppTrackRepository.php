<?php

namespace App\Repository;

use App\Entity\PcaEvenementAppTrack;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PcaEvenementAppTrack|null find($id, $lockMode = null, $lockVersion = null)
 * @method PcaEvenementAppTrack|null findOneBy(array $criteria, array $orderBy = null)
 * @method PcaEvenementAppTrack[]    findAll()
 * @method PcaEvenementAppTrack[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PcaEvenementAppTrackRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PcaEvenementAppTrack::class);
    }

    // /**
    //  * @return PcaEvenementAppTrack[] Returns an array of PcaEvenementAppTrack objects
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
    public function findOneBySomeField($value): ?PcaEvenementAppTrack
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
