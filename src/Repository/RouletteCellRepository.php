<?php

namespace App\Repository;

use App\Entity\RouletteCell;
use App\Entity\Round;
use App\Entity\Spin;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RouletteCell|null find($id, $lockMode = null, $lockVersion = null)
 * @method RouletteCell|null findOneBy(array $criteria, array $orderBy = null)
 * @method RouletteCell[]    findAll()
 * @method RouletteCell[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RouletteCellRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RouletteCell::class);
    }

    /**
     * @param Round $round
     * @return array
     */
    public function getAvailableForRound(Round $round)
    {
        $lockedCells = $round->getSpins()->map(function (Spin $spin) {
            return $spin->getDroppedCell()->getId();
        })->toArray();

        $queryBuilder = $this->createQueryBuilder('c');

        if ($lockedCells) {
            $queryBuilder
                ->where('c.id NOT IN (' . implode(',', $lockedCells) . ')');
        }

        return $queryBuilder->getQuery()
            ->getArrayResult();
    }

    /**
     * @return array
     */
    public function getWeightsMap(): array
    {
        $map = [];
        foreach ($this->findAll() as $cell) {
            $map[$cell->getId()] = $cell->getWeight();
        }

        return $map;
    }
}
