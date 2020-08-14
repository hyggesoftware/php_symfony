<?php

namespace App\Repository;

use App\Entity\Spin;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Spin|null find($id, $lockMode = null, $lockVersion = null)
 * @method Spin|null findOneBy(array $criteria, array $orderBy = null)
 * @method Spin[]    findAll()
 * @method Spin[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SpinRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Spin::class);
    }
}
