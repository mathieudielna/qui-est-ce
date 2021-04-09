<?php

namespace App\Repository;

use App\Entity\Exercicepca;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Exercicepca|null find($id, $lockMode = null, $lockVersion = null)
 * @method Exercicepca|null findOneBy(array $criteria, array $orderBy = null)
 * @method Exercicepca[]    findAll()
 * @method Exercicepca[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExercicepcaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Exercicepca::class);
    }

    // /**
    //  * @return Exercicepca[] Returns an array of Exercicepca objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Exercicepca
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
