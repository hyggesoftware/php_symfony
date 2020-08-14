<?php

namespace App\Controller;

use App\Service\Statistics;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class StatisticsController extends JsonController
{
    /**
     * @var Statistics
     */
    private $statistics;

    /**
     * StatisticsController constructor.
     * @param Statistics $statistics
     */
    public function __construct(Statistics $statistics)
    {
        $this->statistics = $statistics;
        parent::__construct();
    }

    /**
     * @Route("/statistics", name="getRouletteStatistics")
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->json([
            "active_users" => $this->statistics->getActiveUsersStatistics(),
            "users_count_by_total_rounds" => $this->statistics->getUsersCountByTotalRounds(),
        ]);
    }
}