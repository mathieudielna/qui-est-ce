<?php

namespace App\Repository;

use App\Entity\RgpdAudit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method RgpdAudit|null find($id, $lockMode = null, $lockVersion = null)
 * @method RgpdAudit|null findOneBy(array $criteria, array $orderBy = null)
 * @method RgpdAudit[]    findAll()
 * @method RgpdAudit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RgpdAuditRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RgpdAudit::class);
    }

    /**
     * @return RgpdAudit[] Returns an array of RgpdAudit objects
     */
    public function findAllCustomerUser($customer,$people): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT ad
             FROM App\Entity\RgpdAudit ad
             WHERE ad.customer = :customer 
             AND ad.responsable = :people
             OR :people MEMBER OF ad.contributeurs'
             
        )
        ->setParameter('customer', $customer)
        ->setParameter('people', $people);

        // returns an array of Product objects
        return $query->getResult();
    }

    /*
    public function findOneBySomeField($value): ?RgpdAudit
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
