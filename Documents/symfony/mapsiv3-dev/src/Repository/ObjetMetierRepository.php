<?php

namespace App\Repository;

use App\Entity\ObjetMetier;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ObjetMetier|null find($id, $lockMode = null, $lockVersion = null)
 * @method ObjetMetier|null findOneBy(array $criteria, array $orderBy = null)
 * @method ObjetMetier[]    findAll()
 * @method ObjetMetier[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ObjetMetierRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ObjetMetier::class);
    }

      	/**
    * @return ObjetMetier[]
    */
    public function findAllCustomerUser($customer,$people): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT om
             FROM App\Entity\ObjetMetier om
             WHERE om.customer = :customer 
             AND (om.responsable = :people OR om.suppleant = :people OR om.redacteur = :people OR :people MEMBER OF om.peoples)'
             
        )
        ->setParameter('customer', $customer)
        ->setParameter('people', $people);

        // returns an array of Product objects
        return $query->getResult();
    }

        /**
    * @return ObjetMetier[]
    */
    public function finduniq($customer,$people,$id): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT om
             FROM App\Entity\ObjetMetier om
             WHERE om.customer = :customer 
             AND om.id = :id 
             AND (om.responsable = :people OR om.suppleant = :people OR om.redacteur = :people OR :people MEMBER OF om.peoples)'
        )
        ->setParameter('customer', $customer)
        ->setParameter('people', $people)
        ->setParameter('id', $id);

        // returns an array of Product objects
        return $query->getResult();
    }
}
