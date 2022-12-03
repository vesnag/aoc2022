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

        $windowSize = $numberOfElves;
        $caloriesCountWindow = [];
        $chunkSumCalculated = true;
        while (($line = fgets($handle)) !== false) {
            if (is_numeric($line)) {
                $chunkSumCalculated = false;
                $currentChunkSum += (int) $line;
                continue;
            }
            self::addToTotalCaloriesCount($caloriesCountWindow, $currentChunkSum, $windowSize);
            $currentChunkSum = 0;
            $chunkSumCalculated = true;
        }

        if (!$chunkSumCalculated) {
            self::addToTotalCaloriesCount($caloriesCountWindow, $currentChunkSum, $windowSize);
        }

        fclose($handle);

        return (int) array_sum($caloriesCountWindow);
    }

   /**
   * @param array<int, int> $caloriesCountWindow
   */
    private static function addToTotalCaloriesCount(array &$caloriesCountWindow, int $currentChunkSum, int $windowSize): void
    {
        if (count($caloriesCountWindow) < $windowSize) {
            self::addToTotalCaloriesCountAndSort($caloriesCountWindow, $currentChunkSum);
            return;
        }

        if ($currentChunkSum <= $caloriesCountWindow[0]) {
            return;
        }

        self::addToTotalCaloriesCountAndSort($caloriesCountWindow, $currentChunkSum);
        array_shift($caloriesCountWindow);
    }

   /**
   * @param array<int, int> $totalCaloriesCountWindow
   */
    private static function addToTotalCaloriesCountAndSort(array &$totalCaloriesCountWindow, int $currentChunkSum): void
    {
        $totalCaloriesCountWindow[] = $currentChunkSum;
        sort($totalCaloriesCountWindow);
    }
}
