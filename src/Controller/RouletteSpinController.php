<?php

namespace App\Controller;

use App\Entity\Round;
use App\Entity\Spin;
use App\Entity\User;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class RouletteSpinController extends JsonController
{
    /**
     * @Route("/roulette/spin", name="storeRouletteSpin", methods={"POST"})
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        /** @var User $user */
        $user = $this->getDoctrine()->getRepository(User::class)->findOneBy([
            "api_key" => $request->get('api_key')
        ]);

        if ($user) {
            // if user have no active rounds, create new one
            if (null === ($round = $user->getActiveRound())) {
                $round = new Round;
                $round->setUserId($user);
            }

            // create spin
            $spin = new Spin;

            // Generating random cell to drop

            if ($availableCells = $round->getAvailableCells()) {
                $randomCell = $availableCells[array_rand($availableCells)];
                $spin->setDroppedCell($randomCell);
                // set jackpot
                $spin->setIsJackpot(false);
            } else {
                $spin->setIsJackpot(true);
            }

            // persist data
            $this->getDoctrine()->getManager()->persist($spin);

            $round->addSpin($spin);
            $this->getDoctrine()->getManager()->persist($round);

            $this->getDoctrine()->getManager()->persist($user);

            $this->getDoctrine()->getManager()->flush();

            return $this->responseEntity($round);
        }
    }
}