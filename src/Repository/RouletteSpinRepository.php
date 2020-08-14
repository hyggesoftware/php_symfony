<?php

namespace App\Repository;

use App\Entity\RouletteSpin;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RouletteSpin|null find($id, $lockMode = null, $lockVersion = null)
 * @method RouletteSpin|null findOneBy(array $criteria, array $orderBy = null)
 * @method RouletteSpin[]    findAll()
 * @method RouletteSpin[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RouletteSpinRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RouletteSpin::class);
    }

    // /**
    //  * @return RouletteSpin[] Returns an array of RouletteSpin objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RouletteSpin
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
