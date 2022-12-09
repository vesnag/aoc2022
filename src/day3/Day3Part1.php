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
            $sum += self::getCommonItemTypeValue(trim($line));
        }

        return $sum;
    }

    private static function getCommonItemTypeValue(string $line): int
    {
        $size = strlen($line);

        $firstRucksackIndex = 0;
        $firstRucksackIndexMaxIndex = $size / 2;

        while ($firstRucksackIndex <= $firstRucksackIndexMaxIndex) {
            $currentCharacter = mb_substr($line, $firstRucksackIndex, 1);
            $secondRucksackIndex = $size - 1;
            while ($secondRucksackIndex >= $firstRucksackIndexMaxIndex) {
                $currentCharacterSecondRucksack = mb_substr($line, $secondRucksackIndex, 1);
                if ($currentCharacterSecondRucksack === $currentCharacter) {
                    return self::getCharValue($currentCharacter);
                }
                $secondRucksackIndex--;
            }
            $firstRucksackIndex++;
        }

        return 0;
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
