<?php

namespace App\Repository;

use App\Entity\TypeSysteme;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TypeSysteme|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeSysteme|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeSysteme[]    findAll()
 * @method TypeSysteme[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeSystemeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TypeSysteme::class);
    }

    // /**
    //  * @return TypeSysteme[] Returns an array of TypeSysteme objects
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
    public function findOneBySomeField($value): ?TypeSysteme
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
