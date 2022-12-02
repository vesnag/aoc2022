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

        $maxSumArray = [];
        $chunkSumCalculated = true;
        while (($line = fgets($handle)) !== false) {
            if (is_numeric($line)) {
                $chunkSumCalculated = false;
                $currentChunkSum += (int) $line;
                continue;
            }

            $maxSumArray[] = $currentChunkSum;
            $currentChunkSum = 0;
            $chunkSumCalculated = true;
        }

        if (!$chunkSumCalculated) {
            $maxSumArray[] = $currentChunkSum;
        }

        rsort($maxSumArray);

        $sumCalories = 0;
        for ($i = 0; $i < $numberOfElves; $i++) {
            $sumCalories += $maxSumArray[$i];
        }

        return $sumCalories;
    }
}
