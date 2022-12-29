<?php

namespace AOC2022\day1;

final class Day1Part2
{
    public function calculateTotalCalories(string $filename, int $numberOfElves): int
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

        $totalCalories = 0;
        $elvesWithHighestCalories = [];
        while (($line = fgets($inputFileHandle)) !== false) {
            if (!empty(trim($line))) {
                $currentChunkSum += (int) $line;

                if (!feof($inputFileHandle)) {
                    continue;
                }
            }

            if (count($elvesWithHighestCalories) < $numberOfElves) {
                $totalCalories += $currentChunkSum;
                $elvesWithHighestCalories[] = $currentChunkSum;
                $currentMin = min($elvesWithHighestCalories);
                $currentChunkSum = 0;

                continue;
            }

            if ($currentChunkSum > $currentMin) {
                $totalCalories += $currentChunkSum;
                $elvesWithHighestCalories[] = $currentChunkSum;
                sort($elvesWithHighestCalories);
                $totalCalories -= $elvesWithHighestCalories[0];
                array_shift($elvesWithHighestCalories);
                $currentMin = $elvesWithHighestCalories[0];
            }
            $currentChunkSum = 0;
        }

        fclose($inputFileHandle);

        return $totalCalories;
    }
}
