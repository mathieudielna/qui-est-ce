<?php

namespace App\Repository;

use App\Entity\Site;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Site|null find($id, $lockMode = null, $lockVersion = null)
 * @method Site|null findOneBy(array $criteria, array $orderBy = null)
 * @method Site[]    findAll()
 * @method Site[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SiteRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Site::class);
    }

    /**
    * @return Site[]
    */
    public function findAllCustomerUser($customer,$people): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT s
             FROM App\Entity\Site s
             WHERE s.customer = :customer 
             AND s.responsable = :people'
        )
        ->setParameter('customer', $customer)
        ->setParameter('people', $people);

        // returns an array of Product objects
        return $query->getResult();
    }

     /**
    * @return Site[]
    */
    public function finduniq($customer,$people,$id): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT s
             FROM App\Entity\Site s
             WHERE s.customer = :customer 
             AND s.id = :id 
             AND (s.responsable = :people OR s.suppleant = :people)'
        )
        ->setParameter('customer', $customer)
        ->setParameter('people', $people)
        ->setParameter('id', $id);

        // returns an array of Product objects
        return $query->getResult();
    }
}
