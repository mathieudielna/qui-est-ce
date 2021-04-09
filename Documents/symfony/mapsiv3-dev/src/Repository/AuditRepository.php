<?php

namespace App\Repository;
use App\Entity\Audit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Audit|null find($id, $lockMode = null, $lockVersion = null)
 * @method Audit|null findOneBy(array $criteria, array $orderBy = null)
 * @method Audit[]    findAll()
 * @method Audit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AuditRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Audit::class);
    }

    /**
    * @return Audit[]
    */
    public function findAllCustomerUser($customer,$people, $conformite): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT au
             FROM App\Entity\Audit au
             WHERE au.customer = :customer 
             AND (au.responsable = :people OR au.suppleant = :people OR :people MEMBER OF au.Peoples) 
             AND :conformite MEMBER OF au.typeconformite'
        )
        ->setParameter('customer', $customer)
        ->setParameter('people', $people)
        ->setParameter('conformite', $conformite);

        // returns an array of Product objects
        return $query->getResult();
    }

     /**
    * @return Audit[]
    */
    public function findAllConformite($customer, $conformite): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT au
             FROM App\Entity\Audit au
             WHERE au.customer = :customer 
             AND :conformite MEMBER OF au.typeconformite'
        )
        ->setParameter('customer', $customer)
        ->setParameter('conformite', $conformite);

        // returns an array of Product objects
        return $query->getResult();
    }

    /**
    * @return Audit[]
    */
    public function finduniq($customer,$people,$id): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT au
             FROM App\Entity\Audit au
             WHERE au.customer = :customer 
             AND au.id = :id 
             AND (au.responsable = :people OR au.suppleant = :people OR :people MEMBER OF au.Peoples)'
        )
        ->setParameter('customer', $customer)
        ->setParameter('people', $people)
        ->setParameter('id', $id);

        // returns an array of Product objects
        return $query->getResult();
    }
}
