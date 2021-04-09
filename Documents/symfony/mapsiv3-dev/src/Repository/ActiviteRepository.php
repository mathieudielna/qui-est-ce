<?php

namespace App\Repository;

use App\Entity\Activite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Activite|null find($id, $lockMode = null, $lockVersion = null)
 * @method Activite|null findOneBy(array $criteria, array $orderBy = null)
 * @method Activite[]    findAll()
 * @method Activite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActiviteRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Activite::class);
    }

    /**
    * @return Activite[]
    */
    public function findAllCustomerUser($customer,$people): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT a
             FROM App\Entity\Activite a
             WHERE a.customer = :customer  
             AND (a.responsable = :people OR a.suppleant = :people OR :people MEMBER OF a.peoples)'
        )
        ->setParameter('customer', $customer)
        ->setParameter('people', $people);

        // returns an array of Product objects
        return $query->getResult();
    }
    
    /**
    * @return Activite[]
    */
    public function finduniq($customer,$people,$id): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT a
             FROM App\Entity\Activite a
             WHERE a.customer = :customer 
             AND a.id = :id 
             AND (a.responsable = :people OR a.suppleant = :people OR :people MEMBER OF a.peoples)'
        )
        ->setParameter('customer', $customer)
        ->setParameter('people', $people)
        ->setParameter('id', $id);

        // returns an array of Product objects
        return $query->getResult();
    }
}
