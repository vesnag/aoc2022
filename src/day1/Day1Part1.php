<?php

namespace AOC2022\day1;

final class Day1Part1
{
    public static function getMaxTotalCalories(string $filename): int
    {
        $inputFileHandle = fopen('input/day1/' . $filename, 'r');
        if (!$inputFileHandle) {
            return 0;
        }

        $maxSum = 0;
        $currentChunkSum = 0;

        while (($line = fgets($inputFileHandle)) !== false) {
            if (is_numeric($line)) {
                $currentChunkSum += (int) $line;

                if (!feof($inputFileHandle)) {
                    continue;
                }
            }

            if ($currentChunkSum > $maxSum) {
                $maxSum = $currentChunkSum;
            }
            $currentChunkSum = 0;
        }

        fclose($inputFileHandle);

        return $maxSum;
    }
}
