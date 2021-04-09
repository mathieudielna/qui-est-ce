<?php

namespace App\Repository;

use App\Entity\TypeDcpjuridique;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TypeDcpjuridique|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeDcpjuridique|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeDcpjuridique[]    findAll()
 * @method TypeDcpjuridique[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeDcpjuridiqueRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TypeDcpjuridique::class);
    }

    // /**
    //  * @return TypeDcpjuridique[] Returns an array of TypeDcpjuridique objects
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
    public function findOneBySomeField($value): ?TypeDcpjuridique
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
