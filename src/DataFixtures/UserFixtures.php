<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Exception;

class UserFixtures extends Fixture
{
    protected $users = [
        'candydog',
        'peacefulcake',
        'thegeneralwolf',
        'jadeitecherry',
    ];

    /**
     * @param ObjectManager $manager
     *
     * @throws Exception
     */
    public function load(ObjectManager $manager)
    {
        foreach ($this->users as $username) {
            $user = new User;
            $user->setEmail("$username@gmail.com");
            $user->setApiKey(md5(random_bytes(16)));

            $manager->persist($user);
        }

        $manager->flush();
    }
}
