<?php

namespace AOC2022\day1;

final class Day1Part1
{
    public function calculateTotalCalories(string $filename): int
    {
        $inputFileHandle = fopen('input/day1/' . $filename, 'r');
        if (!$inputFileHandle) {
            return 0;
        }

        $maximumCaloriesTotal = 0;
        $currentChunkSum = 0;

        while (($line = fgets($inputFileHandle)) !== false) {
            if (empty(trim($line))) {
                if ($currentChunkSum > $maximumCaloriesTotal) {
                    $maximumCaloriesTotal = $currentChunkSum;
                }
                $currentChunkSum = 0;

                continue;
            }

            $currentChunkSum += (int) $line;
        }

        fclose($inputFileHandle);

        return $maximumCaloriesTotal;
    }
}
