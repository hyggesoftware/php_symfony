<?php

namespace App\Service;

class RandomDistribution
{
    /**
     * Returns random element of array, based on element weights
     *
     * @param array $array
     * @param array $arrayWeights
     *
     * @return mixed|null
     */
    public function getRandomElementOfArray(array $array, array $arrayWeights = [])
    {
        if ($arrayWeights) {
            $total = 0;
            $distribution = [];

            foreach ($array as $arrayItem) {
                $weight = $arrayWeights[$arrayItem] ?? 0;
                $total += $weight;
                $distribution[$arrayItem] = $total;
            }

            $rand = mt_rand(0, $total - 1);
            foreach ($distribution as $number => $weights) {
                if ($rand < $weights) {
                    return $number;
                }
            }
        }

        return $array[array_rand($array)];
    }
}