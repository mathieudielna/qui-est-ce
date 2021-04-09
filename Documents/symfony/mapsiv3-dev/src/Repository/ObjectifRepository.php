<?php

namespace App\Repository;

use App\Entity\Objectif;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Objectif|null find($id, $lockMode = null, $lockVersion = null)
 * @method Objectif|null findOneBy(array $criteria, array $orderBy = null)
 * @method Objectif[]    findAll()
 * @method Objectif[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ObjectifRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Objectif::class);
    }


    /**
    * @return Objectif[]
    */
    public function findAllCustomerUser($customer,$people, $conformite): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT o
             FROM App\Entity\Objectif o
             WHERE o.customer = :customer 
             AND (o.responsable = :people OR o.suppleant = :people OR :people MEMBER OF o.peoples) 
             AND :conformite MEMBER OF o.typeconformites'
        )
        ->setParameter('customer', $customer)
        ->setParameter('people', $people)
        ->setParameter('conformite', $conformite);

        // returns an array of Product objects
        return $query->getResult();
    }

      /**
    * @return Objectif[]
    */
    public function findAllCustomerUs($customer,$people): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT o
             FROM App\Entity\Objectif o
             WHERE o.customer = :customer 
             AND (o.responsable = :people OR o.suppleant = :people OR :people MEMBER OF o.peoples)'
        )
        ->setParameter('customer', $customer)
        ->setParameter('people', $people);

        // returns an array of Product objects
        return $query->getResult();
    }

     /**
    * @return Objectif[]
    */
    public function findAllConformite($customer, $conformite): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT o
             FROM App\Entity\Objectif o
             WHERE o.customer = :customer 
             AND :conformite MEMBER OF o.typeconformites'
        )
        ->setParameter('customer', $customer)
        ->setParameter('conformite', $conformite);

        // returns an array of Product objects
        return $query->getResult();
    }

    /**
    * @return Objectif[]
    */
    public function finduniq($customer,$people,$id): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT o
             FROM App\Entity\Objectif o
             WHERE o.customer = :customer 
             AND o.id = :id 
             AND (o.responsable = :people OR o.suppleant = :people OR :people MEMBER OF o.peoples)'
        )
        ->setParameter('customer', $customer)
        ->setParameter('people', $people)
        ->setParameter('id', $id);

        // returns an array of Product objects
        return $query->getResult();
    }
}
