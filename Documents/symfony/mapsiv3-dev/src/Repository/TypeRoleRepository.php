<?php

namespace App\Repository;

use App\Entity\TypeRole;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TypeRole|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeRole|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeRole[]    findAll()
 * @method TypeRole[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeRoleRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TypeRole::class);
    }

    // /**
    //  * @return TypeRole[] Returns an array of TypeRole objects
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
    public function findOneBySomeField($value): ?TypeRole
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
