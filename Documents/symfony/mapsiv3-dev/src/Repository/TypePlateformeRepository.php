<?php

namespace App\Repository;

use App\Entity\TypePlateforme;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TypePlateforme|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypePlateforme|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypePlateforme[]    findAll()
 * @method TypePlateforme[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypePlateformeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TypePlateforme::class);
    }

    // /**
    //  * @return TypePlateforme[] Returns an array of TypePlateforme objects
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
    public function findOneBySomeField($value): ?TypePlateforme
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
