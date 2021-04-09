<?php

namespace App\Repository;

use App\Entity\Processus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Processus|null find($id, $lockMode = null, $lockVersion = null)
 * @method Processus|null findOneBy(array $criteria, array $orderBy = null)
 * @method Processus[]    findAll()
 * @method Processus[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProcessusRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Processus::class);
    }
    

   /**
    * @return Processus[]
    */
    public function findAllCustomerUser($customer,$people): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT p
             FROM App\Entity\Processus p
             WHERE p.customer = :customer 
             AND (p.responsable = :people OR p.suppleant = :people OR :people MEMBER OF p.peoples)'
        )
        ->setParameter('customer', $customer)
        ->setParameter('people', $people);

        // returns an array of Product objects
        return $query->getResult();
    }

        /**
        * @return Processus[]
        */
        public function finduniq($customer,$people,$id): array
        {
            $entityManager = $this->getEntityManager();

            $query = $entityManager->createQuery(
                'SELECT p
                FROM App\Entity\Processus p
                WHERE p.customer = :customer 
                AND p.id = :id 
                AND (p.responsable = :people OR p.suppleant = :people OR :people MEMBER OF p.peoples)'
            )
            ->setParameter('customer', $customer)
            ->setParameter('people', $people)
            ->setParameter('id', $id);

            // returns an array of Product objects
            return $query->getResult();
        }

}
