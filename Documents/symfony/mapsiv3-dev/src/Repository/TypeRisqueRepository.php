<?php

namespace App\Repository;

use App\Entity\TypeRisque;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TypeRisque|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeRisque|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeRisque[]    findAll()
 * @method TypeRisque[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeRisqueRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TypeRisque::class);
    }

    // /**
    //  * @return TypeRisque[] Returns an array of TypeRisque objects
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
    public function findOneBySomeField($value): ?TypeRisque
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
