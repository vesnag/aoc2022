<?php

namespace AOC2022\day1;

final class Day1Part1
{
    public static function getMaxTotalCalories(string $filename): int
    {
        $handle = fopen('input/day1/' . $filename, 'r');
        if (!$handle) {
            return 0;
        }

        $maxSum = 0;
        $currentChunkSum = 0;

        $chunkSumCalculated = true;
        while (($line = fgets($handle)) !== false) {
            if (is_numeric($line)) {
                $chunkSumCalculated = false;
                $currentChunkSum += (int) $line;
                continue;
            }

            $maxSum = self::returnMaxSum($currentChunkSum, $maxSum);
            $currentChunkSum = 0;
        }

        if (!$chunkSumCalculated) {
            $maxSum = self::returnMaxSum($currentChunkSum, $maxSum);
        }

        fclose($handle);

        return $maxSum;
    }

    private static function returnMaxSum(int $currentSum, int $maxSum): int
    {
        if ($currentSum > $maxSum) {
            return $currentSum;
        }
        return $maxSum;
    }
}
