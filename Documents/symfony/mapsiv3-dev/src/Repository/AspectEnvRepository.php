<?php

namespace App\Repository;

use App\Entity\AspectEnv;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AspectEnv|null find($id, $lockMode = null, $lockVersion = null)
 * @method AspectEnv|null findOneBy(array $criteria, array $orderBy = null)
 * @method AspectEnv[]    findAll()
 * @method AspectEnv[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AspectEnvRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AspectEnv::class);
    }

     /**
    * @return AspectEnv[]
    */
    public function findAllCustomerUser($customer,$people): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT aes
             FROM App\Entity\AspectEnv aes
             WHERE aes.customer = :customer 
             AND (aes.responsable = :people OR aes.suppleant = :people OR :people MEMBER OF aes.peoples)'
        )
        ->setParameter('customer', $customer)
        ->setParameter('people', $people);

        // returns an array of Product objects
        return $query->getResult();
    }

     /**
    * @return AspectEnv[]
    */
    public function findAllConformite($customer, $conformite): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT aes
             FROM App\Entity\AspectEnv aes
             WHERE aes.customer = :customer 
             AND :conformite MEMBER OF aes.typeconformite'
        )
        ->setParameter('customer', $customer)
        ->setParameter('conformite', $conformite);

        // returns an array of Product objects
        return $query->getResult();
    }

    /**
    * @return AspectEnv[]
    */
    public function finduniq($customer,$people,$id): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT aes
             FROM App\Entity\AspectEnv aes
             WHERE aes.customer = :customer 
             AND aes.id = :id 
             AND (aes.responsable = :people OR aes.suppleant = :people OR :people MEMBER OF aes.peoples)'
        )
        ->setParameter('customer', $customer)
        ->setParameter('people', $people)
        ->setParameter('id', $id);

        // returns an array of Product objects
        return $query->getResult();
    }
}
