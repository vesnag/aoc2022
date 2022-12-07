<?php

namespace AOC2022\day1;

final class Day1
{
    public static function getMaxTotalCalories(string $filename, int $numberOfElves): int
    {
        if ($numberOfElves <= 0) {
            return 0;
        }

        $handle = fopen('input/day1/' . $filename, 'r');
        if (!$handle) {
            return 0;
        }

        $currentChunkSum = 0;
        $currentMin = 0;

        $caloriesSum = 0;
        $i = 0;
        $maxCaloriesBucket = [];
        while (($line = fgets($handle)) !== false) {
            if (is_numeric($line)) {
                $currentChunkSum += (int) $line;
                continue;
            }

            if ($i < $numberOfElves) {
                $caloriesSum += $currentChunkSum;
                $maxCaloriesBucket[] = $currentChunkSum;
                $currentMin = min($maxCaloriesBucket);
                $currentChunkSum = 0;
                $i++;
                continue;
            }

            $caloriesSum = self::maxCaloriesSum($currentChunkSum, $currentMin, $maxCaloriesBucket, $caloriesSum);
            $currentMin = $maxCaloriesBucket[0];
            $currentChunkSum = 0;
        }

        $caloriesSum = self::maxCaloriesSum($currentChunkSum, $currentMin, $maxCaloriesBucket, $caloriesSum);

        fclose($handle);

        return $caloriesSum;
    }

    /**
    * @param array<int, int> $maxCaloriesBucket
    */
    private static function maxCaloriesSum(int $currentChunkSum, int $currentMin, array &$maxCaloriesBucket, int $caloriesSum): int
    {
        if ($currentChunkSum <= $currentMin) {
            return $caloriesSum;
        }

        $caloriesSum += $currentChunkSum;
        $maxCaloriesBucket[] = $currentChunkSum;
        sort($maxCaloriesBucket);

        $caloriesSum -= $maxCaloriesBucket[0];
        array_shift($maxCaloriesBucket);

        return $caloriesSum;
    }

}
