<?php

namespace App\Repository;

use App\Entity\RgpdViolation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method RgpdViolation|null find($id, $lockMode = null, $lockVersion = null)
 * @method RgpdViolation|null findOneBy(array $criteria, array $orderBy = null)
 * @method RgpdViolation[]    findAll()
 * @method RgpdViolation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RgpdViolationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RgpdViolation::class);
    }

    /**
     * @return RgpdViolation[] Returns an array of RgpdAccess objects
     */

  	public function findAllCustomerUser($customer,$people): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT v
             FROM App\Entity\RgpdViolation v
             WHERE v.customer = :customer 
             AND v.responsable = :people
             OR v.suppleant = :people
             OR :people MEMBER OF v.contributeur'
             
        )
        ->setParameter('customer', $customer)
        ->setParameter('people', $people);

        // returns an array of Product objects
        return $query->getResult();
    }

    /*
    public function findOneBySomeField($value): ?RgpdViolation
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
