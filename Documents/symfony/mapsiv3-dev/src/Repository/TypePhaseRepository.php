<?php

namespace App\Repository;

use App\Entity\TypePhase;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TypePhase|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypePhase|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypePhase[]    findAll()
 * @method TypePhase[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypePhaseRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TypePhase::class);
    }

    // /**
    //  * @return TypePhase[] Returns an array of TypePhase objects
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
    public function findOneBySomeField($value): ?TypePhase
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
