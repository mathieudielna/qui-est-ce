<?php

namespace App\Repository;

use App\Entity\TypeConformite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TypeConformite|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeConformite|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeConformite[]    findAll()
 * @method TypeConformite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeConformiteRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TypeConformite::class);
    }

    // /**
    //  * @return TypeConformite[] Returns an array of TypeConformite objects
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
    public function findOneBySomeField($value): ?TypeConformite
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
