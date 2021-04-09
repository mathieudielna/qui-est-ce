<?php

namespace App\Repository;

use App\Entity\JalonConnectAction;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method JalonConnectAction|null find($id, $lockMode = null, $lockVersion = null)
 * @method JalonConnectAction|null findOneBy(array $criteria, array $orderBy = null)
 * @method JalonConnectAction[]    findAll()
 * @method JalonConnectAction[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JalonConnectActionRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, JalonConnectAction::class);
    }

    /**
     * @return JalonConnectAction[]
    */
    public function findAllCustomerUser($customer,$people): array
    {
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery(
            'SELECT a
             FROM App\Entity\JalonConnectAction a
             WHERE a.mcustomer = :customer
             AND a.action IN  (
                SELECT ac
                FROM App\Entity\Action ac
                WHERE ac.responsable = :people
                OR ac.projet IN  (
                    SELECT p
                    FROM App\Entity\Projet p
                    WHERE p.responsable = :people
                    OR p.program IN  (
                        SELECT pr
                        FROM App\Entity\Program pr
                        WHERE pr.responsable = :people
                    )
                )
            )
            OR (a.responsable = :people OR :people MEMBER OF a.peoples)'
        )
        ->setParameter('customer', $customer)
        ->setParameter('people', $people);
        // returns an array of Product objects
        return $query->getResult();
    }

    /**
    * @return JalonConnectAction[]
    */
    public function finduniq($customer,$people,$id): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT a
             FROM App\Entity\JalonConnectAction a
             WHERE a.mcustomer = :customer
             AND a.id = :id
             AND (a.responsable = :people OR :people MEMBER OF a.peoples OR a.action IN  (
                SELECT ac
                FROM App\Entity\Action ac
                WHERE ac.responsable = :people
                OR ac.projet IN  (
                    SELECT p
                    FROM App\Entity\Projet p
                    WHERE p.responsable = :people
                    OR p.program IN  (
                        SELECT pr
                        FROM App\Entity\Program pr
                        WHERE pr.responsable = :people
                    )
                )
            ))
             
             '
        )
        ->setParameter('customer', $customer)
        ->setParameter('people', $people)
        ->setParameter('id', $id);

        // returns an array of Product objects
        return $query->getResult();
    }

}
