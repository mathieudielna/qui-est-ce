<?php

namespace App\Repository;

use App\Entity\RgpdAccess;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method RgpdAccess|null find($id, $lockMode = null, $lockVersion = null)
 * @method RgpdAccess|null findOneBy(array $criteria, array $orderBy = null)
 * @method RgpdAccess[]    findAll()
 * @method RgpdAccess[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RgpdAccessRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RgpdAccess::class);
    }

    /**
     * @return RgpdAccess[] Returns an array of RgpdAccess objects
     */

  	public function findAllCustomerUser($customer,$people): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT acc
             FROM App\Entity\RgpdAccess acc
             WHERE acc.customer = :customer 
             AND acc.responsable = :people
             OR acc.suppleant = :people'
             
        )
        ->setParameter('customer', $customer)
        ->setParameter('people', $people);

        // returns an array of Product objects
        return $query->getResult();
    }
    

    /*
    public function findOneBySomeField($value): ?RgpdAccess
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
