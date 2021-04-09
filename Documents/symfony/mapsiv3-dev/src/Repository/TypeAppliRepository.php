<?php

namespace App\Repository;

use App\Entity\TypeAppli;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TypeAppli|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeAppli|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeAppli[]    findAll()
 * @method TypeAppli[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeAppliRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TypeAppli::class);
    }

    // /**
    //  * @return TypeAppli[] Returns an array of TypeAppli objects
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
    public function findOneBySomeField($value): ?TypeAppli
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
