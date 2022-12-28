<?php

namespace AOC2022\day3;

final class Day3Part2
{
    public function getSumOfGroupBadges(string $filename, int $numberOfRucksack): int
    {
        $inputFileHandle = fopen('input/day3/' . $filename, 'r');
        if (!$inputFileHandle) {
            return 0;
        }

        $sum = 0;
        $rucksackGroup = [];

        while (($line = fgets($inputFileHandle)) !== false) {
            $line = trim($line);

            $rucksackGroup[] = $line;

            if (count($rucksackGroup) === $numberOfRucksack) {
                $sum += self::getBadgeSumForRucksacks($rucksackGroup);
                $rucksackGroup = [];
            }
        }

        fclose($inputFileHandle);

        if (!empty($rucksackGroup)) {
            $sum += self::getBadgeSumForRucksacks($rucksackGroup);
        }

        return $sum;
    }

    /**
     * @param array<int, string> $rucksackGroup
    */
    private static function getBadgeSumForRucksacks(array $rucksackGroup): int
    {
        $i = 0;
        $len = strlen($rucksackGroup[0]);
        $used_chars = [];
        while ($i < $len) {
            $currentCharacter = $rucksackGroup[0][$i];
            if (in_array($currentCharacter, $used_chars)) {
                $i++;
                continue;
            }
            $used_chars[$currentCharacter] = $currentCharacter;
            if (str_contains($rucksackGroup[1], $currentCharacter) && str_contains($rucksackGroup[2], $currentCharacter)) {
                return self::getCharValue($currentCharacter);
            }
            $i++;
        }

        return 0;
    }


    private static function getCharValue(string $char): int
    {
        $decimalValue = ord($char);
        if ($decimalValue >= 65 && $decimalValue <= 90) {
            return $decimalValue - 38;
        }
        if ($decimalValue >= 97 && $decimalValue <= 122) {
            return $decimalValue - 96;
        }

        return 0;
    }
}
