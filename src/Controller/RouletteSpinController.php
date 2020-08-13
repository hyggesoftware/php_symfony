<?php

namespace App\Controller;

use App\Entity\Round;
use App\Entity\Spin;
use App\Entity\User;
use App\Exception\UserNotSetException;
use App\Service\RouletteSpinner;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;

class RouletteSpinController extends JsonController
{
    /**
     * @var RouletteSpinner
     */
    protected $rouletteSpinner;

    /**
     * RouletteSpinController constructor.
     * @param RouletteSpinner $rouletteSpinner
     */
    public function __construct(RouletteSpinner $rouletteSpinner)
    {
        parent::__construct();
        $this->rouletteSpinner = $rouletteSpinner;
    }

    /**
     * @Route("/roulette/spin", name="storeRouletteSpin", methods={"POST"})
     *
     * @param Request $request
     * @return JsonResponse
     *
     */
    public function store(Request $request)
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