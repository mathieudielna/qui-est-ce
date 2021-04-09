<?php

namespace App\Repository;

use App\Entity\Systeme;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Systeme|null find($id, $lockMode = null, $lockVersion = null)
 * @method Systeme|null findOneBy(array $criteria, array $orderBy = null)
 * @method Systeme[]    findAll()
 * @method Systeme[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SystemeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Systeme::class);
    }

    /**
    * @return Systeme[]
    */
    public function findAllCustomerUser($customer,$people): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT s
             FROM App\Entity\Systeme s
             WHERE s.customer = :customer 
             AND (s.responsable = :people OR s.suppleant = :people OR :people MEMBER OF s.peoples)'
        )
        ->setParameter('customer', $customer)
        ->setParameter('people', $people);

        // returns an array of Product objects
        return $query->getResult();
    }

    /**
    * @return Systeme[]
    */
    public function finduniq($customer,$people,$id): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT s
             FROM App\Entity\Systeme s
             WHERE s.customer = :customer 
             AND s.id = :id 
             AND (s.responsable = :people OR s.suppleant = :people OR :people MEMBER OF s.peoples)'
        )
        ->setParameter('customer', $customer)
        ->setParameter('people', $people)
        ->setParameter('id', $id);

        // returns an array of Product objects
        return $query->getResult();
    }
}
