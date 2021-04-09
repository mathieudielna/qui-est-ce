<?php

namespace App\Repository;

use App\Entity\VisiteSite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method VisiteSite|null find($id, $lockMode = null, $lockVersion = null)
 * @method VisiteSite|null findOneBy(array $criteria, array $orderBy = null)
 * @method VisiteSite[]    findAll()
 * @method VisiteSite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VisiteSiteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VisiteSite::class);
    }

    /**
    * @return Visite[]
    */
    public function findAllCustomerUser($customer,$people, $conformite): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT vis
             FROM App\Entity\VisiteSite vis
             WHERE vis.customer = :customer 
             AND (vis.responsable = :people OR vis.suppleant = :people OR :people MEMBER OF vis.peoples) 
             AND :conformite MEMBER OF au.typeconformite'
        )
        ->setParameter('customer', $customer)
        ->setParameter('people', $people)
        ->setParameter('conformite', $conformite);

        // returns an array of Product objects
        return $query->getResult();
    }

     /**
    * @return Visite[]
    */
    public function findAllConformite($customer, $conformite): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT vis
            FROM App\Entity\VisiteSite vis
            WHERE vis.customer = :customer  
             AND :conformite MEMBER OF vis.typeconformite'
        )
        ->setParameter('customer', $customer)
        ->setParameter('conformite', $conformite);

        // returns an array of Product objects
        return $query->getResult();
    }

    /**
    * @return Visite[]
    */
    public function finduniq($customer,$people,$id): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT vis
            FROM App\Entity\VisiteSite vis
            WHERE vis.customer = :customer 
             AND vis.id = :id 
             AND (vis.responsable = :people OR vis.suppleant = :people OR :people MEMBER OF vis.peoples)'
        )
        ->setParameter('customer', $customer)
        ->setParameter('people', $people)
        ->setParameter('id', $id);

        // returns an array of Product objects
        return $query->getResult();
    }
}
