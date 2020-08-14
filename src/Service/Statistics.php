<?php

namespace App\Service;

use App\Entity\Round;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class Statistics
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * Statistics constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Gets statistics of active users:
     * - user_id - ID of User
     * - total_rounds - Total rounds user played
     * - average_spin_count - Average count of spins by round
     *
     * @return array
     */
    public function getActiveUsersStatistics(): array
    {
        $activeUsers = $this->entityManager
            ->getRepository(User::class)
            ->active();

        $activeUsersStatistics = [];

        /** @var User $user */
        foreach ($activeUsers as $user) {
            $spinCounts = $user->getRounds()->map(function (Round $round) {
                return $round->getSpins()->count();
            })->toArray();

            $activeUsersStatistics[] = [
                "user_id" => $user->getId(),
                "total_rounds" => $user->getRounds()->count(),
                "average_spin_count" => array_sum($spinCounts) / count($spinCounts),
            ];
        }

        return $activeUsersStatistics;
    }

    /**
     * Represents count of users, played certain amount of rounds:
     * - total_rounds - How many rounds were played
     * - users_count - How many users played that amount of rounds
     *
     * @return array
     */
    public function getUsersCountByTotalRounds(): array
    {
        return $this->entityManager
            ->getRepository(User::class)
            ->findCountByTotalRounds();
    }
}