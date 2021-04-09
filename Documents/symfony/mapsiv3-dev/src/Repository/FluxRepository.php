<?php

namespace App\Repository;

use App\Entity\Flux;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Flux|null find($id, $lockMode = null, $lockVersion = null)
 * @method Flux|null findOneBy(array $criteria, array $orderBy = null)
 * @method Flux[]    findAll()
 * @method Flux[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FluxRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Flux::class);
    }
    
    
    /**
    * @return Flux[]
    */
    public function findAllCustomerUser($customer,$people): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT f
             FROM App\Entity\Flux f
             WHERE f.customer = :customer 
             AND (f.responsable = :people OR f.suppleant = :people OR f.redacteur = :people OR :people MEMBER OF f.peoples)'
             
        )
        ->setParameter('customer', $customer)
        ->setParameter('people', $people);

        // returns an array of Product objects
        return $query->getResult();
    }

    /**
    * @return Flux[]
    */
    public function finduniq($customer,$people,$id): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT f
            FROM App\Entity\Flux f
            WHERE f.customer = :customer 
             AND f.id = :id 
             AND (f.responsable = :people OR f.suppleant = :people OR f.redacteur = :people OR :people MEMBER OF f.peoples)'
        )
        ->setParameter('customer', $customer)
        ->setParameter('people', $people)
        ->setParameter('id', $id);

        // returns an array of Product objects
        return $query->getResult();
    }

    // /**
    //  * @return Flux[] Returns an array of Flux objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Flux
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
