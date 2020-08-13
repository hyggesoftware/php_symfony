<?php

namespace App\Controller;

use App\Entity\User;
use App\Exception\UserNotSetException;
use App\Service\RouletteSpinner;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Routing\Annotation\Route;

class RouletteSpinController extends JsonController
{
    /**
     * @var RouletteSpinner
     */
    protected $rouletteSpinner;

    /**
     * RouletteSpinController constructor.
     *
     * @param RouletteSpinner $rouletteSpinner
     */
    public function __construct(RouletteSpinner $rouletteSpinner)
    {
        $this->rouletteSpinner = $rouletteSpinner;
        parent::__construct();
    }

    /**
     * @Route("/roulette/spin", name="storeRouletteSpin", methods={"POST"})
     *
     * @param Request $request
     * @return JsonResponse
     *
     */
    public function store(Request $request): JsonResponse
    {
        /** @var User $user */
        $user = $this->getDoctrine()->getRepository(User::class)->findOneBy([
            "api_key" => $request->get('api_key')
        ]);

        try {
            $round = $this->rouletteSpinner
                ->setUser($user)
                ->spin();
        } catch (UserNotSetException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        return $this->responseEntity($round, ['user']);
    }
}