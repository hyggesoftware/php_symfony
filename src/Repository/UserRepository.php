<?php

namespace App\Repository;

use App\Entity\Round;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\DBALException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * Get active users (who have 1 or more rounds)
     *
    * @return User[] Returns an array of User objects
    */
    public function active()
    {
        return $this->createQueryBuilder('u')
            ->leftJoin('u.rounds', 'r')
            ->having('COUNT(r) > 0')
            ->groupBy('u')
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * Get active users count by total rounds played
     *
     * @return array
     *
     * @throws DBALException
     */
    public function findCountByTotalRounds(): array
    {
        $subQuery = $this->createQueryBuilder('u')
            ->leftJoin('u.rounds', 'r')
            ->having('COUNT(r) > 0')
            ->groupBy('u')
            ->select('u.id as id')
            ->addSelect('COUNT(r) AS total_rounds')
            ->getQuery()
            ->getSQL();

        $conn = $this->getEntityManager()
            ->getConnection();

        $sql = '
            SELECT users_rounds.sclr_1 as total_rounds, COUNT(users_rounds.id_0) AS users_count
            FROM (' . $subQuery . ') AS users_rounds
            GROUP BY total_rounds
            ';
        $stmt = $conn->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll();
    }
}
