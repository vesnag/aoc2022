<?php

namespace AOC2022\day3;

final class Day3Part1
{
    public static function getSumOfPriorities(string $filename): int
    {
        $handle = fopen('input/day3/' . $filename, 'r');
        if (!$handle) {
            return 0;
        }

        $sum = 0;
        while (($line = fgets($handle)) !== false) {
            $line = trim($line);
            $size = strlen($line);

            $firstRucksackIndex = 0;
            $firstRucksackIndexMaxIndex = $size / 2;

            while ($firstRucksackIndex <= $firstRucksackIndexMaxIndex) {
                $currentCharacter = mb_substr($line, $firstRucksackIndex, 1);
                $secondRucksackIndex = $size - 1;
                while ($secondRucksackIndex >= $firstRucksackIndexMaxIndex) {
                    $currentCharacterSecondRucksack = mb_substr($line, $secondRucksackIndex, 1);
                    if ($currentCharacterSecondRucksack === $currentCharacter) {
                        $sum += self::getCharValue($currentCharacter);
                        break 2;
                    }
                    $secondRucksackIndex--;
                }
                $firstRucksackIndex++;
            }
        }

        return $sum;
    }

    private static function getCharValue(string $char): int
    {
        $decimalValue = ord($char);
        if ($decimalValue >= 65 &&  $decimalValue <= 90) {
            return $decimalValue - 38;
        }
        if ($decimalValue >= 97 &&  $decimalValue <= 122) {
            return $decimalValue - 96;
        }

        return 0;
    }
}
