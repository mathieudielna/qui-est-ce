<?php

namespace App\Repository;

use App\Entity\Projet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Projet|null find($id, $lockMode = null, $lockVersion = null)
 * @method Projet|null findOneBy(array $criteria, array $orderBy = null)
 * @method Projet[]    findAll()
 * @method Projet[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjetRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Projet::class);
    }
    
    /**
    * @return Projet[]
    */
    public function findAllCustomerUser($customer,$people): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT p
            FROM App\Entity\Projet p
            WHERE p.customer = :customer
            AND p.program IN  (
                SELECT pr
                FROM App\Entity\Program pr
                WHERE pr.responsable = :people
            )
            OR (p.responsable = :people OR p.suppleant = :people OR :people MEMBER OF p.peoples)'
        )
        ->setParameter('customer', $customer)
        ->setParameter('people', $people);

        // returns an array of Product objects
        return $query->getResult();
    }

    /**
    * @return Projet[]
    */
    public function finduniq($customer,$people,$id): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT proj
             FROM App\Entity\Projet proj
             WHERE proj.customer = :customer 
             AND proj.id = :id 
             AND (proj.responsable = :people OR proj.suppleant = :people OR :people MEMBER OF proj.peoples OR proj.program IN  (
                SELECT pr
                FROM App\Entity\Program pr
                WHERE pr.responsable = :people

            ))'
        )
        ->setParameter('customer', $customer)
        ->setParameter('people', $people)
        ->setParameter('id', $id);

        // returns an array of Product objects
        return $query->getResult();
    }

    // Moyenne progression par projet
    
    public function findProgressionProjet($customer, $projetid)
    {
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery(
            'SELECT AVG(jca.progression) as avg_projet
            FROM App\Entity\JalonConnectAction jca
            WHERE jca.mcustomer = :customer
            AND jca.action IN  
            (
                SELECT a
                FROM App\Entity\Action a
                WHERE a.customer = :customer
                AND a.projet IN 
                (
                    SELECT p
                    FROM App\Entity\Projet p
                    WHERE p.customer = :customer
                    AND p.id = :projetid
                )
            )'
        )
        ->setParameter('customer', $customer)
        ->setParameter('projetid', $projetid);

        // returns an array of Product objects
        $projetavg = $query->getSingleScalarResult();
        return $projetavg;
    }

}
