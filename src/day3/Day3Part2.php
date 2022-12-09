<?php

namespace AOC2022\day3;

final class Day3Part2
{
    public static function getSumOfGroupBadges(string $filename, int $numberOfRucksack): int
    {
        $handle = fopen('input/day3/' . $filename, 'r');
        if (!$handle) {
            return 0;
        }

        $rucksackGroup = [];
        $sum = 0;
        $i = 0;

        $minRucksackSize = 0;
        while (($line = fgets($handle)) !== false) {
            $line = trim($line);

            if ($i == $numberOfRucksack) {
                $sum += self::getSumOfGroupBadge($rucksackGroup);

                $minRucksackSize = 0;
                $rucksackGroup = [];
                $i = 0;
            }

            if (0 === $i) {
                $minRucksackSize = strlen($line);
                $rucksackGroup[] = $line;
                $i++;
                continue;
            }

            $rucksackSize = strlen($line);
            if ($rucksackSize < $minRucksackSize) {
                array_unshift($rucksackGroup, $line);
                $minRucksackSize = $rucksackSize;
            } else {
                $rucksackGroup[] = $line;
            }
            $i++;
        }
        $sum += self::getSumOfGroupBadge($rucksackGroup);

        return $sum;
    }

    /**
     * @param array<int, string> $rucksackGroup
    */
    private static function getSumOfGroupBadge(array $rucksackGroup): int
    {
        $i = 0;
        $len = strlen($rucksackGroup[0]);
        $used_chars = [];
        while ($i < $len) {
            $currentCharacter = mb_substr($rucksackGroup[0], $i, 1);
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
