<?php

namespace App\Repository;

use App\Entity\Program;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Program|null find($id, $lockMode = null, $lockVersion = null)
 * @method Program|null findOneBy(array $criteria, array $orderBy = null)
 * @method Program[]    findAll()
 * @method Program[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProgramRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Program::class);
    }

		/**
    * @return Program[]
    */
    public function findAllCustomerUser($customer,$people): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT prog
             FROM App\Entity\Program prog
             WHERE prog.customer = :customer 
             AND (prog.responsable = :people OR prog.suppleant = :people OR :people MEMBER OF prog.peoples)'
        )
        ->setParameter('customer', $customer)
        ->setParameter('people', $people);

        // returns an array of Product objects
        return $query->getResult();
    }

    /**
    * @return Program[]
    */
    public function finduniq($customer,$people,$id): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT pr
             FROM App\Entity\Program pr
             WHERE pr.customer = :customer 
             AND pr.id = :id 
             AND (pr.responsable = :people OR pr.suppleant = :people OR :people MEMBER OF pr.peoples)'
        )
        ->setParameter('customer', $customer)
        ->setParameter('people', $people)
        ->setParameter('id', $id);

        // returns an array of Product objects
        return $query->getResult();
    }

     // Moyenne progression par programme
    
     public function findProgressionProgram($customer, $programid)
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
                    AND p.program IN
                    (
                        SELECT prog
                        FROM App\Entity\Program prog
                        WHERE p.customer = :customer
                        AND prog.id = :programid
                    )
                )
            )'
        )
         ->setParameter('customer', $customer)
         ->setParameter('programid', $programid);
 
         // returns an array of Product objects
         $programavg = $query->getSingleScalarResult();
         return $programavg;
     }


}
