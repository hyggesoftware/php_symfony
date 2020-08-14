<?php

namespace App\DataFixtures;

use App\Entity\RouletteCell;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Exception;

class CellWeightsFixtures extends Fixture
{
    protected $weights = [
        1 => 20,
        2 => 100,
        3 => 45,
        4 => 70,
        5 => 15,
        6 => 140,
        7 => 20,
        8 => 20,
        9 => 140,
        10 => 45,
    ];

    /**
     * @param ObjectManager $manager
     *
     * @throws Exception
     */
    public function load(ObjectManager $manager)
    {
        foreach ($this->weights as $index => $weight) {
            $cell = new RouletteCell;
            $cell->setIndex($index)
                ->setWeight($weight);

            $manager->persist($cell);
        }

        $manager->flush();
    }
}
