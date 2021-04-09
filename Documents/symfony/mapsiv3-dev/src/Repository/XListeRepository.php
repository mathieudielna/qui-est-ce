<?php

namespace App\Repository;

use App\Entity\XListe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method XListe|null find($id, $lockMode = null, $lockVersion = null)
 * @method XListe|null findOneBy(array $criteria, array $orderBy = null)
 * @method XListe[]    findAll()
 * @method XListe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class XListeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, XListe::class);
    }

    // /**
    //  * @return XListe[] Returns an array of XListe objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('x')
            ->andWhere('x.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('x.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?XListe
    {
        return $this->createQueryBuilder('x')
            ->andWhere('x.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
