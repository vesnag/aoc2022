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
        $slidingWindowData = [];
        $chunkSumCalculated = true;
        while (($line = fgets($handle)) !== false) {
            if (is_numeric($line)) {
                $chunkSumCalculated = false;
                $currentChunkSum += (int) $line;
                continue;
            }
            self::addToSlidingWindow($slidingWindowData, $currentChunkSum, $windowSize);
            $currentChunkSum = 0;
            $chunkSumCalculated = true;
        }

        if (!$chunkSumCalculated) {
            self::addToSlidingWindow($slidingWindowData, $currentChunkSum, $windowSize);
        }

        fclose($handle);

        return (int) array_sum($slidingWindowData);
    }

   /**
   * @param array<int, int> $slidingWindowData
   */
    private static function addToSlidingWindow(array &$slidingWindowData, int $currentChunkSum, int $windowSize): void
    {
        if (count($slidingWindowData) < $windowSize) {
            self::addSumToSlidingWindowAndSort($slidingWindowData, $currentChunkSum);
            return;
        }

        if ($currentChunkSum <= $slidingWindowData[0]) {
            return;
        }

        self::addSumToSlidingWindowAndSort($slidingWindowData, $currentChunkSum);
        array_shift($slidingWindowData);
    }

   /**
   * @param array<int, int> $slidingWindowData
   */
    private static function addSumToSlidingWindowAndSort(array &$slidingWindowData, int $currentChunkSum): void
    {
        $slidingWindowData[] = $currentChunkSum;
        sort($slidingWindowData);
    }
}
