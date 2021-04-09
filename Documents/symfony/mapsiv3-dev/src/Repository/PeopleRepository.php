<?php

namespace App\Repository;

use App\Entity\People;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method People|null find($id, $lockMode = null, $lockVersion = null)
 * @method People|null findOneBy(array $criteria, array $orderBy = null)
 * @method People[]    findAll()
 * @method People[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PeopleRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, People::class);
    }

    /**
    * @return People[]
    */
    public function findAllCustomerUser($customer): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT p
             FROM App\Entity\People p
             WHERE p.customer = :customer'
        )
        ->setParameter('customer', $customer);
        return $query->getResult();
    }
    
    /**
    * @return People[]
    */
    public function finduniq($customer,$people,$id,$metier): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT p
             FROM App\Entity\People p
             WHERE p.customer = :customer 
             AND p.id = :id 
             AND (p.n1 = :people OR p.metier = :metier)'
        )
        ->setParameter('customer', $customer)
        ->setParameter('people', $people)
        ->setParameter('metier', $metier)
        ->setParameter('id', $id);

        // returns an array of Product objects
        return $query->getResult();
    }
}
