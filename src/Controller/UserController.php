<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends JsonController
{
    /**
     * @Route("/users/", name="getUsers")
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $users = $this->getDoctrine()
            ->getRepository(User::class)
            ->findAll();

        return $this->responseArray($users);
    }
}