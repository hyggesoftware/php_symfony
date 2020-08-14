<?php

namespace App\Repository;

use App\Entity\RouletteRound;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RouletteRound|null find($id, $lockMode = null, $lockVersion = null)
 * @method RouletteRound|null findOneBy(array $criteria, array $orderBy = null)
 * @method RouletteRound[]    findAll()
 * @method RouletteRound[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RouletteRoundRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RouletteRound::class);
    }

    // /**
    //  * @return RouletteRound[] Returns an array of RouletteRound objects
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
    public function findOneBySomeField($value): ?RouletteRound
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
