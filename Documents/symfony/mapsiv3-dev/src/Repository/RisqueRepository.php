<?php
namespace App\Repository;

use App\Entity\Risque;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Risque|null find($id, $lockMode = null, $lockVersion = null)
 * @method Risque|null findOneBy(array $criteria, array $orderBy = null)
 * @method Risque[]    findAll()
 * @method Risque[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RisqueRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Risque::class);
    }

    /**
    * @return Risque[]
    */
    public function findAllCustomerUser($customer,$people, $conformite): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT r
             FROM App\Entity\Risque r
             WHERE r.customer = :customer 
             AND (r.responsable = :people OR r.suppleant = :people)
             AND :conformite MEMBER OF r.typeconformite'
        )
        ->setParameter('customer', $customer)
        ->setParameter('people', $people)
        ->setParameter('conformite', $conformite);

        // returns an array of Product objects
        return $query->getResult();
    }

     /**
    * @return ri[]
    */
    public function findAllConformite($customer, $conformite): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT ri
             FROM App\Entity\Risque ri
             WHERE ri.customer = :customer 
             AND :conformite MEMBER OF ri.typeconformite'
        )
        ->setParameter('customer', $customer)
        ->setParameter('conformite', $conformite);

        // returns an array of Product objects
        return $query->getResult();
    }
}
