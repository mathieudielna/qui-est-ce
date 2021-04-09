<?php

namespace App\Repository;

use App\Entity\Metier;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Metier|null find($id, $lockMode = null, $lockVersion = null)
 * @method Metier|null findOneBy(array $criteria, array $orderBy = null)
 * @method Metier[]    findAll()
 * @method Metier[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MetierRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Metier::class);
    }

   /**
    * @return Metier[]
    */
    public function findAllCustomerUser($customer,$people): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT m
             FROM App\Entity\Metier m
             WHERE m.customer = :customer 
             AND (m.directeur = :people OR m.suppleant = :people OR :people MEMBER OF m.peoples)'
        )
        ->setParameter('customer', $customer)
        ->setParameter('people', $people);

        // returns an array of Product objects
        return $query->getResult();
    }

     /**
    * @return Metier[]
    */
    public function finduniq($customer,$people,$id): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT m
             FROM App\Entity\Metier m
             WHERE m.customer = :customer 
             AND m.id = :id 
             AND (m.directeur = :people OR m.suppleant = :people OR :people MEMBER OF m.peoples)'
        )
        ->setParameter('customer', $customer)
        ->setParameter('people', $people)
        ->setParameter('id', $id);

        // returns an array of Product objects
        return $query->getResult();
    }
}
