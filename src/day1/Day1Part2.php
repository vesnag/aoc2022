<?php

namespace AOC2022\day1;

final class Day1Part2
{
    public static function getMaxTotalCalories(string $filename, int $numberOfElves): int
    {
        if ($numberOfElves <= 0) {
            return 0;
        }

        $inputFileHandle = fopen('input/day1/' . $filename, 'r');
        if (!$inputFileHandle) {
            return 0;
        }

        $currentChunkSum = 0;
        $currentMin = 0;

        $caloriesSum = 0;
        $i = 0;
        $maxCaloriesBucket = [];
        while (($line = fgets($inputFileHandle)) !== false) {
            if (is_numeric($line)) {
                $currentChunkSum += (int) $line;

                if (!feof($inputFileHandle)) {
                    continue;
                }
            }

            if ($i < $numberOfElves) {
                $caloriesSum += $currentChunkSum;
                $maxCaloriesBucket[] = $currentChunkSum;
                $currentMin = min($maxCaloriesBucket);
                $currentChunkSum = 0;

                $i++;
                continue;
            }

            if ($currentChunkSum > $currentMin) {
                $caloriesSum += $currentChunkSum;
                $maxCaloriesBucket[] = $currentChunkSum;
                sort($maxCaloriesBucket);
                $caloriesSum -= $maxCaloriesBucket[0];
                array_shift($maxCaloriesBucket);
                $currentMin = $maxCaloriesBucket[0];
            }
            $currentChunkSum = 0;

            $i++;
        }

        fclose($inputFileHandle);

        return $caloriesSum;
    }
}
