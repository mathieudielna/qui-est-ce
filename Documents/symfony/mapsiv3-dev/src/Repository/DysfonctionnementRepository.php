<?php

namespace App\Repository;

use App\Entity\Dysfonctionnement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Dysfonctionnement|null find($id, $lockMode = null, $lockVersion = null)
 * @method Dysfonctionnement|null findOneBy(array $criteria, array $orderBy = null)
 * @method Dysfonctionnement[]    findAll()
 * @method Dysfonctionnement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DysfonctionnementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Dysfonctionnement::class);
    }

        /**
    * @return Dysfonctionnement[]
    */
    public function findAllCustomerUser($customer,$people, $conformite): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT dy
             FROM App\Entity\Dysfonctionnement dy
             WHERE dy.customer = :customer 
             AND (dy.responsable = :people OR dy.suppleant = :people OR :people MEMBER OF dy.peoples) 
             AND :conformite MEMBER OF dy.typeconformite'
        )
        ->setParameter('customer', $customer)
        ->setParameter('people', $people)
        ->setParameter('conformite', $conformite);

        // returns an array of Product objects
        return $query->getResult();
    }

     /**
    * @return Dysfonctionnement[]
    */
    public function findAllConformite($customer, $conformite): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT dy
             FROM App\Entity\Dysfonctionnement dy
             WHERE dy.customer = :customer 
             AND :conformite MEMBER OF dy.typeconformite'
        )
        ->setParameter('customer', $customer)
        ->setParameter('conformite', $conformite);

        // returns an array of Product objects
        return $query->getResult();
    }

    /**
    * @return Dysfonctionnement[]
    */
    public function finduniq($customer,$people,$id): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT dy
             FROM App\Entity\Dysfonctionnement dy
             WHERE dy.customer = :customer  
             AND dy.id = :id 
             AND (dy.responsable = :people OR dy.suppleant = :people OR :people MEMBER OF dy.peoples)'
        )
        ->setParameter('customer', $customer)
        ->setParameter('people', $people)
        ->setParameter('id', $id);

        // returns an array of Product objects
        return $query->getResult();
    }
}
