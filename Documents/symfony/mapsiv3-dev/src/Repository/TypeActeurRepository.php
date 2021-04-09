<?php

namespace App\Repository;

use App\Entity\TypeActeur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TypeActeur|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeActeur|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeActeur[]    findAll()
 * @method TypeActeur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeActeurRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TypeActeur::class);
    }

    // /**
    //  * @return TypeActeur[] Returns an array of TypeActeur objects
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
    public function findOneBySomeField($value): ?TypeActeur
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
