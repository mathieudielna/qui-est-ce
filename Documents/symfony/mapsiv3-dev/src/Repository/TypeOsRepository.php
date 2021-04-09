<?php

namespace App\Repository;

use App\Entity\TypeOs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TypeOs|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeOs|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeOs[]    findAll()
 * @method TypeOs[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeOsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TypeOs::class);
    }

    // /**
    //  * @return TypeOs[] Returns an array of TypeOs objects
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
    public function findOneBySomeField($value): ?TypeOs
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
