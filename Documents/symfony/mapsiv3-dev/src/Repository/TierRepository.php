<?php

namespace App\Repository;

use App\Entity\Tier;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Tier|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tier|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tier[]    findAll()
 * @method Tier[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TierRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Tier::class);
    }

    /**
    * @return Tier[]
    */
    public function findAllCustomerUser($customer,$people): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT t
             FROM App\Entity\Tier t
             WHERE t.customer = :customer 
             AND (t.responsable = :people OR t.suppleant = :people OR :people MEMBER OF t.peoples)'
        )
        ->setParameter('customer', $customer)
        ->setParameter('people', $people);

        // returns an array of Product objects
        return $query->getResult();
    }

     /**
    * @return Tier[]
    */
    public function finduniq($customer,$people,$id): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT t
             FROM App\Entity\Tier t
             WHERE t.customer = :customer 
             AND t.id = :id 
             AND (t.responsable = :people OR t.suppleant = :people OR :people MEMBER OF t.peoples)'
        )
        ->setParameter('customer', $customer)
        ->setParameter('people', $people)
        ->setParameter('id', $id);

        // returns an array of Product objects
        return $query->getResult();
    }

}
