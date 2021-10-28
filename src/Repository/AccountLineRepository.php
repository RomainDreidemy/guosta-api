<?php

namespace App\Repository;

use App\Entity\AccountLine;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AccountLine|null find($id, $lockMode = null, $lockVersion = null)
 * @method AccountLine|null findOneBy(array $criteria, array $orderBy = null)
 * @method AccountLine[]    findAll()
 * @method AccountLine[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AccountLineRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AccountLine::class);
    }

    // /**
    //  * @return AccountLine[] Returns an array of AccountLine objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AccountLine
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
