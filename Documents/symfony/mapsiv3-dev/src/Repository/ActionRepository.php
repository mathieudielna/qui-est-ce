<?php

namespace App\Repository;

use App\Entity\Action;
use App\Entity\People;
use App\Entity\TypeStatut;
use App\Entity\MapsiCustomer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Action|null find($id, $lockMode = null, $lockVersion = null)
 * @method Action|null findOneBy(array $criteria, array $orderBy = null)
 * @method Action[]    findAll()
 * @method Action[]    findBy(array $criteria, array $orderBy = datefin, $limit = null, $offset = null)
 */
class ActionRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Action::class);
    }

	/**
    * @return Action[]
    */
    public function findAllCustomerUser($customer,$people): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT a
             FROM App\Entity\Action a
             WHERE a.customer = :customer 
             AND a.archive IS NULL  
             AND (a.responsable = :people OR a.suppleant = :people OR :people MEMBER OF a.people)
             OR a.projet IN  (
                SELECT p
                FROM App\Entity\Projet p
                WHERE p.responsable = :people
                OR p.program IN  (
                    SELECT pr
                    FROM App\Entity\Program pr
                    WHERE pr.responsable = :people
                )
            )'
        )
        ->setParameter('customer', $customer)
        ->setParameter('people', $people);

        // returns an array of Product objects
        return $query->getResult();
    }

    /**
    * @return Action[]
    */
    public function findAllCustomerConformite($customer,$people,$conformite): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT a
             FROM App\Entity\Action a
             WHERE a.customer = :customer 
             AND a.archive IS NULL  
             AND :conformite MEMBER OF a.typeconformite
             AND (a.responsable = :people OR a.suppleant = :people OR :people MEMBER OF a.people OR a.projet IN  (
                SELECT p
                FROM App\Entity\Projet p
                WHERE p.responsable = :people
                OR p.program IN  (
                    SELECT pr
                    FROM App\Entity\Program pr
                    WHERE pr.responsable = :people
                )
            ))'
        )
        ->setParameter('customer', $customer)
        ->setParameter('people', $people)
        ->setParameter('conformite', $conformite);

        // returns an array of Product objects
        return $query->getResult();
    }

    /**
    * @return Action[]
    */
    public function findAllConformite($customer, $conformite): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT a
             FROM App\Entity\Action a
             WHERE a.customer = :customer 
             AND a.archive IS NULL 
             AND :conformite MEMBER OF a.typeconformite'
        )
        ->setParameter('customer', $customer)
        ->setParameter('conformite', $conformite);

        // returns an array of Product objects
        return $query->getResult();
    }

    /**
    * @return Action[]
    */
    public function finduniq($customer,$people,$id): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT a
             FROM App\Entity\Action a
             WHERE a.customer = :customer 
             AND a.id = :id 
             AND (a.responsable = :people OR a.suppleant = :people OR :people MEMBER OF a.people OR a.projet IN  (
                SELECT p
                FROM App\Entity\Projet p
                WHERE p.responsable = :people
                OR p.program IN  (
                    SELECT pr
                    FROM App\Entity\Program pr
                    WHERE pr.responsable = :people
                )
            ))'
        )
        ->setParameter('customer', $customer)
        ->setParameter('people', $people)
        ->setParameter('id', $id);

        // returns an array of Product objects
        return $query->getResult();
    }



    // Moyenne progression par action
    
    public function findProgressionAction($customer,$actionid)
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
        'SELECT AVG(jca.progression) as avg_action
        FROM App\Entity\JalonConnectAction jca
        WHERE jca.action = :actionid
        AND jca.mcustomer = :customer'
        )
        ->setParameter('customer', $customer)
        ->setParameter('actionid', $actionid);

        // returns an array of Product objects
        $actionavg = $query->getSingleScalarResult();
        return $actionavg;
    }

 

    // public function findProgressionAction($customer,$actionid)
    // {
    //     $conn = $this->getEntityManager()->getConnection();

    //     $actionavg = 'SELECT AVG(progression) 
    //     FROM App\Entity\JalonConnectAction 
    //     WHERE action_id = :actionid
    //     AND customer = :customer';
    //     $stmt = $conn->prepare($actionavg);
    //     $stmt->execute(['customer' => $customer, 'actionid' => $actionid]);

    //     // returns an array of arrays (i.e. a raw data set)
    //     return $actionavg;
    // }

}
