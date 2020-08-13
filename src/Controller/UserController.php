<?php

namespace App\Controller;

use App\Entity\User;

class UserController extends JsonController
{
    /**
     * @Route("/users/", name="getUsers")
     */
    public function index()
    {
        $users = $this->getDoctrine()
            ->getRepository(User::class)
            ->findAll();

        return $this->responseArray($users);
    }
}