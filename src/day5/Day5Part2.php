<?php

namespace AOC2022\day5;

final class Day5Part2
{
    public static function findTopCrate(string $filename): string
    {
        $handle = fopen('input/day5/' . $filename, 'r');
        if (!$handle) {
            return '';
        }

        $skipLine = false;
        $stackFilled = false;
        $stack = [];
        $stackTopCrates = [];
        while (($line = fgets($handle)) !== false) {
            if ($skipLine) {
                $skipLine = false;
                continue;
            }

            if (true === $stackFilled) {
                self::rearrangeStackAndGetTopCrates($line, $stack, $stackTopCrates);
                continue;
            }

            $stackFilled = self::fillStack($line, $stack);
            if ($stackFilled) {
                $skipLine = true;
            }
        }

        ksort($stackTopCrates, SORT_NUMERIC);

        return implode($stackTopCrates);
    }

    /**
     * @param array<int, array<int, string>> $stack
     * @param array<int, mixed> $stackTopCrates
     */
    private static function rearrangeStackAndGetTopCrates(string $line, array &$stack, array &$stackTopCrates): void
    {
        $numbers = self::getNumbersFromString($line);

        $numberOfMoves = $numbers[0];
        $from = $numbers[1];
        $to = $numbers[2];

        $fromIndex = $from - 1;
        $toIndex = $to - 1;
        $cratesToMove = array_slice($stack[$fromIndex], 0, $numberOfMoves);

        $stack[$toIndex] = array_merge($cratesToMove, $stack[$toIndex]);

        $stackFromIndex = $stack[$fromIndex];
        array_splice($stackFromIndex, 0, $numberOfMoves);
        $stack[$fromIndex] = $stackFromIndex;

        $stackTopCrates[$toIndex] = $cratesToMove[0];
        $stackTopCrates[$fromIndex] = $stack[$fromIndex][0] ?? '';
    }

    /**
     * @param array<int, array<int, string>> $stack
     */
    private static function fillStack(string $line, array &$stack): bool
    {
        $stackIndex = 0;
        for ($i = 1; isset($line[$i]); $i = $i+4) {
            $crate = $line[$i];
            if ($crate === PHP_EOL) {
                return false;
            }
            if (is_numeric($crate)) {
                return true;
            }

            if (ord($crate) === 32) {
                $stackIndex++;
                continue;
            }

            $stack[$stackIndex][] = $crate;

            if (empty($stackTopCrates[$stackIndex])) {
                $stackTopCrates[$stackIndex] = $crate;
            }

            $stackIndex++;
        }

        return false;
    }

    /**
    * @return array<int, int>
    */
    private static function getNumbersFromString(string $string): array
    {
        $matches = [];
        preg_match_all('/\d+/', $string, $matches);

        return $matches[0];
    }
}
